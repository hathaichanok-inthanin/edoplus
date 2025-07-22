<table>
    <thead>
        <tr>
            <th>ชื่อสมาชิก</th>
            <th>พันธมิตร</th>
            <th>โปรโมชั่น</th>
            <th>วันที่รับสิทธิ์</th>
            <th>CODE</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($redeem_points as $redeem_point => $value)
            @php
                $name = DB::table('members')
                    ->where('id', $value->member_id)
                    ->value('name');
                $surname = DB::table('members')
                    ->where('id', $value->member_id)
                    ->value('surname');
                $partner_name = DB::table('partner_shops')
                    ->where('id', $value->partner_id)
                    ->value('name');
                $partner_branch = DB::table('partner_shops')
                    ->where('id', $value->partner_id)
                    ->value('branch');
                $partner_promotion = DB::table('partner_shop_promotions')
                    ->where('id', $value->promotion_id)
                    ->value('promotion');
            @endphp
            <tr>
                <td>{{ $name }} {{ $surname }}</td>
                <td>{{ $partner_name }} {{ $partner_branch }}</td>
                <td>{!! $partner_promotion !!}</td>
                <td>{{ $value->date }}</td>
                <td>{{ $value->code }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
