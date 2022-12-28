<?php

namespace App\Exports;

use App\Models\Bill;
use App\Models\Vender;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BillExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Bill::get();

        foreach ($data as $k => $Bill) {

            $venders  = Bill::vendor($Bill->vender_id);
            $category  = Bill::ProposalCategory($Bill->category_id);
            if ($Bill->status == 0) {
                $status = 'Draft';
            } elseif ($Bill->status == 1) {
                $status = 'Sent';
            } elseif ($Bill->status == 2) {
                $status = 'Unpaid';
            } elseif ($Bill->status == 3) {
                $status = 'Partialy Paid';
            } elseif ($Bill->status == 4) {
                $status = 'Paid';
            }
            unset($Bill->discount_apply, $Bill->shipping_display, $Bill->id, $Bill->created_by, $Bill->updated_at, $Bill->created_at);
            if(!\Auth::guard('vender')->check())
            {
                $data[$k]["bill_id"] = \Auth::user()->billNumberFormat($Bill->bill_id);
            }
            else{
                $data[$k]["bill_id"] = Vender::billNumberFormat($Bill->bill_id);
            }
            $data[$k]["vender_id"]          = $venders;
            $data[$k]["category_id"]   = $category;
            $data[$k]["status"]          = $status;
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            "Bill Id",
            "Vender Name",
            "Bill Date",
            "Due Date",
            "Order Number",
            "status",
            "Send Date",
            "category Name",

        ];
    }
}
