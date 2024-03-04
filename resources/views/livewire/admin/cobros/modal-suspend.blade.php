<div class="m-1.5 flex">



    <div x-data="{ modalSuspend: @entangle('openModalSuspend').live }">

        <!-- Modal backdrop -->
        <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-50 transition-opacity" x-show="modalSuspend"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" x-cloak></div>
        <!-- Modal dialog -->
        <div id="danger-modal"
            class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center transform px-4 sm:px-6"
            role="dialog" aria-modal="true" x-show="modalSuspend"
            x-transition:enter="transition ease-in-out duration-200" x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in-out duration-200"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
            x-cloak>
            <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full"
                @click.outside="modalSuspend = false" @keydown.escape.window="modalSuspend = false">
                <div class="p-5 flex space-x-4">
                    <!-- Icon -->
                    <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 bg-rose-100">
                        <svg class="w-4 h-4 shrink-0 fill-current text-rose-500" viewBox="0 0 16 16">
                            <path
                                d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z" />
                        </svg>
                    </div>
                    <!-- Content -->
                    <div>
                        <!-- Modal header -->
                        <div class="mb-2">
                            <div class="text-lg font-semibold text-slate-800">Suspender Servicio</div>

                        </div>
                        <!-- Modal content -->
                        <div class="text-sm mb-10">
                            <div class="space-y-2">
                                <p> Estas seguro de suspender este Servicio?. </p>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex flex-wrap justify-end space-x-2 text-right">
                            <button class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600"
                                @click="modalSuspend = false">Cancelar</button>
                            <button wire:click="SuspendCobro" class="btn-sm bg-rose-500 hover:bg-rose-600 text-white"
                                @click="modalSuspend = false">
                                Si, Suspender</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
