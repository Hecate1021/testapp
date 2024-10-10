<div>
    <!-- char-area -->
    <section class="message-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="chat-area">
                        <!-- chatbox -->
                        <div class="chatbox">
                            <div class="modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="msg-head">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="d-flex align-items-center">
                                                    <span class="chat-icon"><img class="img-fluid"
                                                            src="https://mehedihtml.com/chatbox/assets/img/arroleftt.svg"
                                                            alt="image title"></span>
                                                    <div class="flex-shrink-0">
                                                        <img class="img-fluid"
                                                            src="https://mehedihtml.com/chatbox/assets/img/user.png"
                                                            alt="user img">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h3>{{ $user->name }}</h3>
                                                        <p>{{ $user->email }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <ul class="moreoption">
                                                    <li class="navbar nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" href="#"
                                                            role="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false"><i class="fa fa-ellipsis-v"
                                                                aria-hidden="true"></i></a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="#">Action</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="#">Another
                                                                    action</a></li>
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li><a class="dropdown-item" href="#">Something
                                                                    else here</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal-body">
                                        <div class="msg-body">
                                            <ul>
                                                @foreach ($messages as $message)
                                                    @if ($message['sender'] != auth()->user()->name)
                                                        <li class="sender">
                                                            <p> {{ $message['message'] }}</p>
                                                            <span class="time">10:06 am</span>
                                                        </li>
                                                    @else
                                                        <li class="repaly">
                                                            <p>{{ $message['message'] }}</p>
                                                            <span class="time">10:20 am</span>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>


                                    <div class="send-box">
                                        <form wire:submit.prevent="sendMessage" class="d-flex">
                                            <input type="text" wire:model="message" class="form-control"
                                                aria-label="message" required placeholder="Write message…"
                                                style="border-radius: 20px 0 0 20px;">
                                            <button type="submit" class="btn btn-primary"
                                                style="border-radius: 0 20px 20px 0;">
                                                <i class="fa fa-paper-plane" aria-hidden="true"></i> Send
                                            </button>
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
</section>
<!-- char-area -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


