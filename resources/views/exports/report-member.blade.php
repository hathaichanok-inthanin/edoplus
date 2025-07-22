<table>
    <thead>
        <tr>
            <th>รหัสสมาชิก</th>
            <th>หมายเลขบัตรประชาชน</th>
            <th>คำนำหน้า</th>
            <th>ชื่อสมาชิก</th>
            <th>นามสกุล</th>
            <th>วัน/เดือน/ปีเกิด</th>
            <th>เบอร์โทรศัพท์</th>
            <th>วันที่สมัครสมาชิก</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $member => $value)
            <tr>
                <td>{{ $value->serialnumber }}</td>
                <td>{{ $value->card_id }}</td>
                <td>{{ $value->title }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->surname }}</td>
                <td>{{ $value->bday }}</td>
                <td>{{ $value->tel }}</td>
                <td>{{ $value->date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
