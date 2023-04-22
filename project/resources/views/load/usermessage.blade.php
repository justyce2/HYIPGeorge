                      @foreach($conv->messages as $message)
                        @if($message->user_id != 0)
                        <div class="single-reply-area user">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="reply-area">
                                        <div class="left">
                                            <p>{{$message->message}}</p>
                                        </div>
                                        <div class="right">
                                            <img class="img-circle" src="{{$message->conversation->user->photo != null ? asset('assets/images/'.$message->conversation->user->photo) : asset('assets/images/noimage.png')}}" alt="">
                                            <p class="ticket-date">{{$message->conversation->user->name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        @else
                        <div class="single-reply-area admin">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="reply-area">
                                        <div class="left">
                                            <img class="img-circle" src="{{ asset('assets/images/admin.jpg')}}" alt="">
                                            <p class="ticket-date">{{__('Admin')}}</p>
                                        </div>
                                        <div class="right">
                                            <p>{{$message->message}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        @endif
                        @endforeach