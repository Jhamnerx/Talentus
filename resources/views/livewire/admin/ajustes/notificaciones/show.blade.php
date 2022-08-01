<div class="p-6 space-y-6">
    <!-- General -->
    <section>
        <!-- Notification -->
        <div>
            <h2 class="text-2xl text-slate-800 font-bold mb-6">Notificaciones</h2>
            <div class="space-y-3">

                <!-- Start -->
                <div x-show="open" x-data="{ open: true }">
                    <div
                        class="inline-flex flex-col max-w-lg px-4 py-2 rounded-sm text-sm bg-white shadow-lg border border-slate-200 text-slate-600">
                        <div class="flex w-full justify-between items-start">
                            <div class="flex">
                                <svg class="w-4 h-4 shrink-0 fill-current text-amber-500 mt-[3px] mr-3"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z" />
                                </svg>
                                <div>
                                    <div class="font-medium text-slate-800 mb-1">Merged Pull Request</div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing sed do eiusmod tempor
                                        incididunt ut
                                        labore et dolore.</div>
                                </div>
                            </div>
                            <button class="opacity-70 hover:opacity-80 ml-3 mt-[3px]" @click="open = false">
                                <div class="sr-only">Close</div>
                                <svg class="w-4 h-4 fill-current">
                                    <path
                                        d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                                </svg>
                            </button>
                        </div>
                        <div class="text-right mt-1">
                            <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">Action -&gt;</a>
                        </div>
                    </div>
                    <!-- End -->
                </div>

                <!-- Start -->
                <div x-show="open" x-data="{ open: true }">
                    <div
                        class="inline-flex flex-col max-w-lg px-4 py-2 rounded-sm text-sm bg-white shadow-lg border border-slate-200 text-slate-600">
                        <div class="flex w-full justify-between items-start">
                            <div class="flex">
                                <svg class="w-4 h-4 shrink-0 fill-current text-emerald-500 mt-[3px] mr-3"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zM7 11.4L3.6 8 5 6.6l2 2 4-4L12.4 6 7 11.4z" />
                                </svg>
                                <div>
                                    <div class="font-medium text-slate-800 mb-1">Merged Pull Request</div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing sed do eiusmod tempor
                                        incididunt ut
                                        labore et dolore.</div>
                                </div>
                            </div>
                            <button class="opacity-70 hover:opacity-80 ml-3 mt-[3px]" @click="open = false">
                                <div class="sr-only">Close</div>
                                <svg class="w-4 h-4 fill-current">
                                    <path
                                        d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                                </svg>
                            </button>
                        </div>
                        <div class="text-right mt-1">
                            <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">Action -&gt;</a>
                        </div>
                    </div>
                </div>
                <!-- End -->

                <!-- Start -->
                <div x-show="open" x-data="{ open: true }">
                    <div
                        class="inline-flex flex-col max-w-lg px-4 py-2 rounded-sm text-sm bg-white shadow-lg border border-slate-200 text-slate-600">
                        <div class="flex w-full justify-between items-start">
                            <div class="flex">
                                <svg class="w-4 h-4 shrink-0 fill-current text-rose-500 mt-[3px] mr-3"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm3.5 10.1l-1.4 1.4L8 9.4l-2.1 2.1-1.4-1.4L6.6 8 4.5 5.9l1.4-1.4L8 6.6l2.1-2.1 1.4 1.4L9.4 8l2.1 2.1z" />
                                </svg>
                                <div>
                                    <div class="font-medium text-slate-800 mb-1">Merged Pull Request</div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing sed do eiusmod tempor
                                        incididunt ut
                                        labore et dolore.</div>
                                </div>
                            </div>
                            <button class="opacity-70 hover:opacity-80 ml-3 mt-[3px]" @click="open = false">
                                <div class="sr-only">Close</div>
                                <svg class="w-4 h-4 fill-current">
                                    <path
                                        d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                                </svg>
                            </button>
                        </div>
                        <div class="text-right mt-1">
                            <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">Action -&gt;</a>
                        </div>
                    </div>
                </div>
                <!-- End -->

                <!-- Start -->
                <div x-show="open" x-data="{ open: true }">
                    <div
                        class="inline-flex flex-col max-w-lg px-4 py-2 rounded-sm text-sm bg-white shadow-lg border border-slate-200 text-slate-600">
                        <div class="flex w-full justify-between items-start">
                            <div class="flex">
                                <svg class="w-4 h-4 shrink-0 fill-current text-indigo-500 mt-[3px] mr-3"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm1 12H7V7h2v5zM8 6c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1z" />
                                </svg>
                                <div>
                                    <div class="font-medium text-slate-800 mb-1">Merged Pull Request</div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing sed do eiusmod tempor
                                        incididunt ut
                                        labore et dolore.</div>
                                </div>
                            </div>
                            <button class="opacity-70 hover:opacity-80 ml-3 mt-[3px]" @click="open = false">
                                <div class="sr-only">Close</div>
                                <svg class="w-4 h-4 fill-current">
                                    <path
                                        d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z" />
                                </svg>
                            </button>
                        </div>
                        <div class="text-right mt-1">
                            <a class="font-medium text-indigo-500 hover:text-indigo-600" href="#0">Action -&gt;</a>
                        </div>
                    </div>
                </div>
                <!-- End -->

            </div>
        </div>
    </section>
    <!-- Panel footer -->


</div>