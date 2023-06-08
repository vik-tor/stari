<script lang="ts">
    let search: string;
    search = "";

    let sidebarOpen = false;
    let sbar: string;
    const toggleBar = () => {
        console.log("toggled");
    };

    const handleSearch = (q: Event) => {};
</script>

<div class="main relative text-slate-900 dark:text-slate-50">
    <div
        class="absolute z-50 h-screen w-screen bg-[rgba(12,12,12,.2)] {sidebarOpen
            ? 'visible'
            : 'invisible'}"
    >
        <div
            class="w-72 h-screen border-r border-secondary bg-primary px-2 pt-12"
        >
            <div class="flex flex-col justify-between items-center">
                <ul tabindex="-1" class="menu menu-compact w-full rounded-none">
                    <li
                        class="border-t border-b border-secondary border-opacity-50"
                    >
                        <a href="/">Devices</a>
                    </li>
                    <li class="border-b border-secondary border-opacity-50">
                        <a href="/">Knowledgebase</a>
                    </li>
                    <li class="border-b border-secondary border-opacity-50">
                        <a href="/">Clients</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="w-full flex">
        <div class="w-[30%] mr-auto bg-primary">
            <div class="h-screen relative flex flex-col">
                <div class="w-[30%] mr-auto flex flex-col mb-2 fixed">
                    <div
                        class="flex justify-between items-center h-12 px-8 border-b border-secondary border-opacity-50"
                    >
                        <div class="flex items-center">
                            <button
                                class="focus:outline-none"
                                on:click={() => {
                                    sidebarOpen = true;
                                }}
                            >
                                <svg
                                    class="h-5 w-5"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    ><path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1"
                                        d="M21 11H3v2H21Zm0-5H3V8H21Zm0 10H3v2H21Z"
                                    /></svg
                                ></button
                            >
                        </div>
                        <div class="">Personal</div>
                        <div class="">
                            <label
                                class="btn btn-ghost bg-none px-2 text-lg hover:bg-transparent hover:border-transparent"
                                for="new-entry-modal"
                            >
                                +
                            </label>
                        </div>
                    </div>
                    <form
                        class="py-1 border-b border-secondary border-opacity-50"
                        action=""
                    >
                        <input
                            type="search"
                            name="search"
                            id="search"
                            placeholder="Search..."
                            class="w-full input input-sm bg-transparent rounded-none border-none px-8 focus:outline-0 focus:ring-0 placeholder:text-slate-500 dark:placeholder:text-slate-300"
                            bind:value={search}
                            on:keyup={handleSearch}
                        />
                    </form>
                </div>
                <!-- <Calendar {times} /> -->
                <div class="w-full px-4 overflow-y-auto mt-24" />
            </div>
        </div>
    </div>
</div>
