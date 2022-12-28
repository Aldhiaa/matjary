<?php

namespace App\Exports;
use App\Models\Customer;
use App\Models\Retainer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RetainerExport implements FromCollection , WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Retainer::get();

        foreach ($data as $k => $retainer) {
            $customer  = Retainer::customers($retainer->customer_id);
            $category  = Retainer::RetainerCategory($retainer->category_id);
            if($retainer->status == 0)
            {
                $status = 'Draft';
            }
            elseif($retainer->status == 1)
            {
                $status = 'Sent';
            }
            elseif($retainer->status == 2)
            {
                $status = 'Unpaid';
            }
            elseif($retainer->status == 3)
            {
                $status = 'Partialy Paid';
            }
            elseif($retainer->status == 4)
            {
                $status = 'Paid';
            }

            unset($retainer->id,$retainer->created_by, $retainer->updated_at, $retainer->created_at);
            if(!\Auth::guard('customer')->check())
            {
                $data[$k]["retainer_id"] = \Auth::user()->retainerNumberFormat($retainer->retainer_id);
            }
            else{
                $data[$k]["retainer_id"]   = Customer::retainerNumberFormat($retainer->retainer_id);
            }            $data[$k]["customer_id"]        = $customer;
            $data[$k]["category_id"]   = $category;
            $data[$k]["status"]          = $status;
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            "Retainer_Id",
            "Customer_name",
            "issue Date",
            "Due Date",
            "Send Date",
            "Category Id",
            "status",
            "discount_apply",
            "converted_invoice_id",
            "is_convert",
        ];
    }
}
