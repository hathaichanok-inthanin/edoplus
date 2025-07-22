@extends('backend/layouts/adminStore/template')
<style>
    .coupon h4 {
        color: #616161e1;
    }

    .coupon h3 {
        color: #a7a7a7e1;
    }

    .coupon p {
        font-size: 14px;
    }

    .coupon span {
        font-size: 14px;
        color: red;
        font-weight: bold;
    }

    .header h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }
</style>
@section('content')

    <div class="container-fluid py-4">
        <div class="header">
            <h4>ใช้คูปอง</h4>
        </div>
        <div class="coupon">
            <div class="row">
                <div class="col-lg-2 mt-4 mb-lg-0 mb-4"></div>
                <div class="col-lg-8 mt-4 mb-lg-0 mb-4">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                            @if (Session::has('alert-' . $msg))
                                <p class="alertdesign alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                                </p>
                            @endif
                        @endforeach
                    </div>
                    <div class="card z-index-2">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">1. เลือกลูกค้า <span>* จำเป็น</span></h6>
                            <p>ค้นหาเบอร์โทรศัพท์</p>
                            <form action="{{ url('admin/search-member-coupon-post') }}">
                                <div class="row">
                                    <div class="col-md-9">
                                        <input class="phone_format form-control" type="text"
                                            placeholder="ค้นหาเบอร์โทรศัพท์" name="search">
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-outline-primary" type="submit"
                                            id="button-addon2">ค้นหาข้อมูล</button>
                                    </div>
                                </div>
                            </form>
                        </div><br>
                    </div>
                    
                </div>
                <div class="col-lg-2 mt-4 mb-lg-0 mb-4"></div>
            </div>
        </div>
    </div>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // number phone
        function phoneFormatter() {
            $('input.phone_format').on('input', function() {
                var number = $(this).val().replace(/[^\d]/g, '')
                if (number.length >= 5 && number.length < 10) {
                    number = number.replace(/(\d{3})(\d{2})/, "$1-$2");
                } else if (number.length >= 10) {
                    number = number.replace(/(\d{3})(\d{3})(\d{3})/, "$1-$2-$3");
                }
                $(this).val(number)
                $('input.phone_format').attr({
                    maxLength: 12
                });
            });
        };
        $(phoneFormatter);
    </script>
@endsection
