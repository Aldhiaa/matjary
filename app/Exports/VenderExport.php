<?php

namespace App\Exports;

use App\Models\Vender;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VenderExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Vender::get();

        foreach ($data as $k => $vendor) {
            unset($vendor->id,$vendor->avatar,$vendor->password, $vendor->lang,$vendor->created_at ,$vendor->updated_at,$vendor->created_by, $vendor->last_login_at, $vendor->is_active, $vendor->email_verified_at, $vendor->remember_token);
            $data[$k]["vender_id"]        = \Auth::user()->venderNumberFormat($vendor->vender_id);
            $data[$k]["balance"]          = \Auth::user()->priceFormat($vendor->balance);
           
        
           
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            "Vendor ID",
            "Name",
            "Email",
            "Contact",
            "Billing Name",
            "Billing Country",
            "Billing State",
            "Billing City",
            "Billing Phone",
            "Billing Zip",
            "Billing Address",
            "Shipping Name",
            "Shipping Country",
            "Shipping State",
            "Shipping City",
            "Shipping Phone",
            "Shipping Zip",
            "Shipping Address",
            "Balance",
        ];
    }
}
