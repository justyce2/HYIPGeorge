                                @foreach($conv->messages as $message)
                                    @if($message->user_id != null)
                                <div class="single-reply-area user">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="reply-area">
                                                <div class="left">
                                                    <p>{{ $message->message }}</p>
                                                </div>
                                                <div class="right">
                                                    <img class="img-circle" src="{{$message->conversation->user->photo != null ? asset('assets/images/'.$message->conversation->user->photo) : asset('assets/images/noimage.png')}}" alt="">
                                                    <a class="d-block profile-btn" href="{{ route('admin-user-show',$message->conversation->user->id) }}" class="d-block">View Profile</a>
                                                    <p class="ticket-date">{{ $message->created_at->diffForHumans() }}</p>
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
                                                    <img class="img-circle" src="{{ Auth::guard('admin')->user()->photo ? asset('assets/images/admins/'.Auth::guard('admin')->user()->photo ):asset('assets/images/noimage.png') }}" alt="">
                                                    <p class="ticket-date">{{ $message->created_at->diffForHumans() }}</p>
                                                </div>
                                                <div class="right">
                                                    <p>{{ $message->message }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>

                                @endif

                                @endforeach