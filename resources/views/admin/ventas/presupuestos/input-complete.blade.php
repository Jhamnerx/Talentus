<div x-data="selectConfigs()" x-init="fetchOptions()" class="flex flex-col items-center relative">
    <div class="w-full">
        <div @click.away="close()" class="my-2 p-1 bg-white flex border border-gray-200 rounded">
            <input x-model="filter" x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @mousedown="open()"
                @keydown.enter.stop.prevent="selectOption()" @keydown.arrow-up.prevent="focusPrevOption()"
                @keydown.arrow-down.prevent="focusNextOption()"
                class="p-1 px-2 appearance-none outline-none w-full text-gray-800 clienteId">
            <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200">
                <button @click="toggle()" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline x-show="!isOpen()" points="18 15 12 20 6 15"></polyline>
                        <polyline x-show="isOpen()" points="18 15 12 9 6 15"></polyline>
                    </svg>

                </button>
            </div>
        </div>
    </div>
    <div x-show="isOpen()"
        class="absolute shadow bg-white top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj">
        <div class="flex flex-col w-full">
            <template x-for="(option, index) in filteredOptions()" :key="index">
                <div @click="onOptionClick(index)" :class="classOption(option.login.uuid, index)"
                    :aria-selected="focusedOptionIndex === index">
                    <div
                        class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                        <div class="w-6 flex flex-col items-center">
                            <div
                                class="flex relative w-5 h-5 bg-orange-500 justify-center items-center m-1 mr-2 w-4 h-4 mt-1 rounded-full ">
                                <img class="rounded-full" alt="A" x-bind:src="option.picture.thumbnail">
                            </div>
                        </div>
                        <div class="w-full items-center flex">
                            <div class="mx-2 -mt-1"><span x-text="option.name.first + ' ' + option.name.last"></span>
                                <div class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500"
                                    x-text="option.email"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>