@extends('backend/layouts/adminStore/template')

@section('content')
    @php
        $files = json_decode($balance->file, true);
    @endphp
    <div class="container">
        <div class="row">
            <h1 style="font-size: 30px; color: #ffffff;" class="text-center mt-5">หลักฐานการใช้บริการ</h1>
            <div style="display: flex; gap: 10px;" class="mt-5 mb-5">
                @foreach ($files as $index => $file)
                    <img src="{{ url('files/bill/' . $file) }}" alt="แนบหลักฐาน" style="max-width: 300px; cursor: zoom-in;"
                        data-bs-toggle="modal" data-bs-target="#zoomModal{{ $index }}">

                    <!-- Modal -->
                    <div class="modal fade" id="zoomModal{{ $index }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <img src="{{ url('files/bill/' . $file) }}" style="width: 100%;" alt="แนบหลักฐาน">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
