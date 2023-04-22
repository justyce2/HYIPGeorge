@extends('layouts.user')

@push('css')
    
@endpush

@section('contents')
<div class="breadcrumb-area">
  <h3 class="title">@lang('Support Tickets')</h3>
  <ul class="breadcrumb">
    <li>
      <a href="user-dashboard.html">@lang('Dashboard')</a>
    </li>
    <li>
      @lang('Support Tickets')
    </li>
  </ul>
</div>

<div class="dashboard--content-item">
  <div class="row justify-content-center">
      <div class="col-lg-4">
          <div class="card default--card h-100">
              <div class="card-body">
                  <div class="chatbox__list__wrapper">
                      <div class="d-flex justify-content-between py-4 border-bottom border--dark">
                          <h3>
                              <a href="{{ route('user.message.index') }}">@lang('Tickets')<i class="fas fa-arrow-right "></i></a>
                          </h3>
                      </div>

                      <ul class="chat__list nav-tab nav border-0">
                          <li>
                              <a class="chat__item active" href="#0">
                                  <div class="item__inner">
                                      <div class="post__creator">
                                          <div
                                              class="post__creator-thumb d-flex justify-content-between">
                                              <span class="username">{{ $data->ticket_number }} </span>
                                          </div>
                                          <div class="post__creator-content">
                                              <h4 class="name d-inline-block">{{ $data->subject }}</h4>
                                          </div>
                                      </div>
                                      <ul class="chat__meta d-flex justify-content-between">
                                          <li><span class="last-msg"></span></li>
                                          <li><span class="last-chat-time">{{ $data->created_at->diffForHumans() }}</span></li>
                                      </ul>
                                  </div>
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-8">
          <div class="card default--card h-100">
              <div class="card-body">
                  <div class="tab-content">
                      <div class="tab-pane show fade active" id="c1">
                          <div class="chat__msg">
                              <div class="chat__msg-header py-2">
                                  <div class="post__creator align-items-center">

                                      <div class="post__creator-content">
                                          <h4 class="name d-inline-block">@lang('Ticket Number') : {{ $data->ticket_number }}
                                          </h4>
                                      </div>
                                      <a class="profile-link" href="javascript:void(0)"></a>
                                  </div>
                              </div>

                              <div class="chat__msg-body">
                                  <ul class="msg__wrapper mt-3">
                                    @foreach($data->messages as $key=>$value)
                                        @if($value->user_id == 0)
                                        <li class="incoming__msg">
                                            <div class="msg__item">
                                                <div class="post__creator">
                                                    <div class="post__creator-content">
                                                        <p>{{ $value->message }}</p>
                                                        <span class="comment-date text--secondary">{{ $value->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @else
                                        <li class="outgoing__msg">
                                            <div class="msg__item">
                                                <div class="post__creator ">
                                                    <div class="post__creator-content">
                                                        <p class="out__msg">{{ $value->message }}
                                                            <br>
                                                            @if ($value->photo != NULL)
                                                                <a href="{{ asset('assets/images/'.$value->photo)}}" download="" class="text-white"><i class="fas fa-paperclip"></i> @lang('attachment')-{{ $key +=1 }}</a>
                                                            @endif
                                                        </p>
                                                        <span class="comment-date text--secondary">{{ $value->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                      @endforeach
                                  </ul>
                              </div>
                                <div class="chat__msg-footer">
                                    <form action="{{ route('user.message.conversation',$data->id) }}" class="send__msg" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-group">
                                          <input id="upload-file" type="file" name="photo" class="form-control d-none">
                                          <label class="-formlabel upload-file" for="upload-file">
                                              <i class="fas fa-cloud-upload-alt"></i>
                                          </label>
                                        </div>

                                      <div class="input-group">
                                          <textarea class="form-control form--control shadow-none" name="message"></textarea>
                                          <button class="border-0 outline-0 send-btn" type="submit"><i class="fab fa-telegram-plane"></i></button>
                                      </div>
                                    </form>
                                </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection

@push('js')

@endpush
