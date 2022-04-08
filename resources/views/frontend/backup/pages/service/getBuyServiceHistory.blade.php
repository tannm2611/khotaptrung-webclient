@extends('frontend.layouts.master')
@section('content')

    <div class="account">
        <div class="" style="margin-top: 15px">
            @if ($message = Session::get('success'))
                <div class="container">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        {{$message}}
                    </div>
                </div>
            @endif
            @if($messages=$errors->all())
                <div class="container">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        {{$messages[0]}}
                    </div>
                </div>

            @endif

        </div>
        <div class="account_content">
            <div class="container">
                @include('frontend.pages.account.sidebar')
                <div class="account_sidebar_content">
                    <div class="account_sidebar_content_title">
                        <p>DỊCH VỤ ĐÃ MUA</p>
                        <div class="account_sidebar_content_line"></div>
                    </div>
                    <div class="account_content_transaction_history">
                        <form class="form-charge account_content_transaction_history__v2">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span >Mã ID</span>
                                        <input type="text" name="serial" class="form-control serial" placeholder="Mã ID">

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span >-- Trạng thái --</span>
                                        <select type="text" name="status" class="form-control status">
                                            <option value="">Chọn trạng thái</option>
                                            <option value="0">Đã hủy</option>
                                            <option value="1">Đang chờ xử lý</option>
                                            <option value="2">Đang thực hiện</option>
                                            <option value="3">Từ chối</option>
                                            <option value="4">Hoàn tất</option>
                                            <option value="5">Thất bại</option>
                                        </select>

                                    </div>
                                </div>
                                @if(isset($categoryservice) && count($categoryservice) > 0)
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span >Loại thẻ</span>
                                            <select name="key" class="form-control key">
                                                <option value="">-- Tất cả các dịch vụ --</option>
                                                @foreach($categoryservice as $val)
                                                    <option value="{{ $val->slug }}">{{ $val->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-4"></div>
                                @endif

                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group date" id="transaction_history_start">
                                        <span class="input-group-btn input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                            <input type="text" class="form-control input-group-addon started_at" name="started_at" autocomplete="off" placeholder="Từ ngày">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <div class="input-group date" id="transaction_history_end">
                                        <span class="input-group-btn input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                        </span>
                                            <input type="text" class="form-control input-group-addon ended_at" name="ended_at" autocomplete="off" placeholder="Đến ngày">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn c-theme-btn c-btn-square m-b-10" type="submit"><i class="fas fa-search"></i> Tìm kiếm</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="javascript:void(0)" class="btn c-btn-square m-b-10 btn-danger btn-hom-nay mb-2 mr-2"><i class="fas fa-calendar-alt"></i> Hôm nay</a>
                                    <a href="javascript:void(0)" class="btn c-btn-square m-b-10 btn-danger btn-hom-qua mb-2 mr-2"><i class="fas fa-calendar-alt"></i> Hôm qua </a>
                                    <a href="javascript:void(0)" class="btn c-btn-square m-b-10 btn-danger btn-thang-nay mb-2 mr-2"><i class="fas fa-calendar-alt"></i> Tháng này</a>
                                    <a href="javascript:void(0)" class="btn c-btn-square m-b-10 c-theme-btn btn-all mb-2 mr-2"><i class="fas fa-calendar-alt"></i> Tất cả</a>
                                </div>
                            </div>
                        </form>

                        <div id="data_pay_card_history">
                            @include('frontend.pages.service.function.__get__buy__service__history')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if ($content = Session::get('content'))
        <div class="modal fade" id="noticeAfterModal" style="display: none;" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="font-weight: bold;text-transform: uppercase;color: #FF0000;text-align: center">Thông báo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body" style="font-family: helvetica, arial, sans-serif;">
                        {!!$content!!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#noticeAfterModal').modal('show');
            });
        </script>
    @endif

    <input type="hidden" class="started_at_day" name="started_at_day" value="{{ \Carbon\Carbon::now()->startOfDay()->format('d/m/Y H:i:s') }}">
    <input type="hidden" class="end_at_day" name="end_at_day" value="{{ \Carbon\Carbon::now()->endOfDay()->format('d/m/Y H:i:s')}}">
    <input type="hidden" class="started_at_yes" name="started_at_yes" value="{{ \Carbon\Carbon::yesterday()->startOfDay()->format('d/m/Y H:i:s') }}">
    <input type="hidden" class="end_at_yes" name="end_at_yes" value="{{ \Carbon\Carbon::yesterday()->endOfDay()->format('d/m/Y H:i:s')}}">
    <input type="hidden" class="started_at_month" name="started_at_month" value="{{ \Carbon\Carbon::now()->startOfMonth()->format('d/m/Y H:i:s') }}">
    <input type="hidden" class="end_at_month" name="end_at_month" value="{{ \Carbon\Carbon::now()->endOfMonth()->format('d/m/Y H:i:s') }}">

    <input type="hidden" name="serial_data" class="serial_data">
    <input type="hidden" name="key_data" class="key_data">
    <input type="hidden" name="status_data" class="status_data">
    <input type="hidden" name="started_at_data" class="started_at_data">
    <input type="hidden" name="ended_at_data" class="ended_at_data">
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    <script src="/assets/frontend/js/charge/charge-history.js"></script>
@endsection
