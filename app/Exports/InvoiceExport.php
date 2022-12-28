<?php

namespace App\Exports;

use App\Models\Customer;
use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class InvoiceExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Invoice::get();

        foreach ($data as $k => $Invoice) {
            $customer  = Invoice::customers($Invoice->customer_id);
            $category  = Invoice::Invoicecategory($Invoice->category_id);
            if($Invoice->status == 0)
            {
                $status = 'Draft';
            }
            elseif($Invoice->status == 1)
            {
                $status = 'Sent';
            }
            elseif($Invoice->status == 2)
            {
                $status = 'Unpaid';
            }
            elseif($Invoice->status == 3)
            {
                $status = 'Partialy Paid';
            }
            elseif($Invoice->status == 4)
            {
                $status = 'Paid';
            }
            unset($Invoice->discount_apply,$Invoice->shipping_display,$Invoice->id,$Invoice->created_by, $Invoice->updated_at, $Invoice->created_at);
            if(!\Auth::guard('customer')->check())
            {
                $data[$k]["invoice_id"] = \Auth::user()->InvoiceNumberFormat($Invoice->invoice_id);
            }
            else{
                $data[$k]["invoice_id"] = Customer::InvoiceNumberFormat($Invoice->invoice_id);
            }
             $data[$k]["customer_id"]        = $customer;
             $data[$k]["category_id"]   = $category;
             $data[$k]["status"]   = $status;

        }

        return $data;
    }

    public function headings(): array
    {
        return [
            "Invoice Id",
            "Customer Name",
            "Issue Date",
            "Due Date",
            "Send Date",
            "Category_name",
            "Ref number",
            "status",
        ];
    }
}
