<script>
    import "../../css/app.css";
    import Modal from "../Components/Modal.svelte";
    import AppSettingsForm from "./Partials/AppSettingsForm.svelte";
    import NewEntryForm from "./Partials/NewEntryForm.svelte";
    import NewNotebookForm from "./Partials/NewNotebookForm.svelte";
    import NotebookSettingsForm from "./Partials/NotebookSettingsForm.svelte";
    import RemoveNotebookForm from "./Partials/RemoveNotebookForm.svelte";
    import SearchForm from "./Partials/SearchForm.svelte";

    export let notebooks;
    export let categories;

    let notebook = notebooks[0];
    let view = null;

    const listEntries = (id) => {
        notebook = notebooks.find((obj) => {
            return obj.id == id;
        });
    };
    const showEntry = (id) => {
        view = notebook.entries.find((o) => {
            return o.id == id;
        });
    };

    const showIcon = (id) => {
        let cat = categories.find((o) => {
            return o.id == id;
        });
        return cat.icon;
    };
</script>

<main class="main relative text-slate-900 dark:text-slate-50">
    <div class="w-full flex">
        <div
            class="w-[5%] hidden sm:block h-screen border-r border-primary bg-secondary"
        >
            <div class="flex flex-col items-center justify-between h-full">
                <div class="flex flex-col items-center">
                    <div class="flex flex-col items-center h-3 my-4">
                        <!-- <button class="focus:outline-none">
							<i class="bi bi-card-heading text-lg" />
						</button> -->
                        <img src="../../../logo.png" alt="Logo" class="w-4" />
                    </div>
                    <ul
                        tabindex="-1"
                        class="menu menu-compact w-full rounded-none items-center"
                    >
                        {#each notebooks as nb}
                            <li
                                class="border-b border-secondary border-opacity-50"
                            >
                                <div
                                    class="md:tooltip md:tooltip-right"
                                    data-tip={nb.name}
                                >
                                    <button
                                        class="py-1"
                                        on:click={listEntries(nb.id)}
                                    >
                                        <i
                                            class="bi bi-{showIcon(
                                                nb.notebook_category_id
                                            )} text-lg"
                                        />
                                    </button>
                                </div>
                            </li>
                        {/each}
                        <li class="my-1">
                            <div
                                class="md:tooltip md:tooltip-right"
                                data-tip="Add notebook"
                            >
                                <button
                                    class="text-error py-1"
                                    onclick="newNotebook_modal.showModal()"
                                >
                                    <i class="bi bi-plus-square text-lg" />
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="m-2">
                    <div
                        class="md:tooltip md:tooltip-right"
                        data-tip="Settings"
                    >
                        <button
                            class="btn btn-ghost btn-circle bg-none p-1 hover:bg-transparent hover:border-transparent w-8 h-8"
                            onclick="appSettings_modal.showModal()"
                        >
                            <i class="bi bi-gear text-lg" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-[100%] md:w-[30%] mr-auto bg-primary">
            <div class="h-screen relative flex flex-col">
                <div
                    class="w-[100%] md:w-[30%] mr-auto flex flex-col mb-2 fixed"
                >
                    <div
                        class="flex justify-between items-center h-12 pl-3 pr-2 border-b border-secondary border-opacity-50"
                    >
                        <div class="ml-2">
                            {#if notebook}
                                <div class="font-semibold text-base">
                                    {notebook.name}
                                </div>
                            {:else}
                                <div class="font-semibold text-base">
                                    Add notebook
                                </div>
                            {/if}
                        </div>
                        <div class="flex gap-2 ml-auto justify-end">
                            <div
                                class="tooltip tooltip-bottom"
                                data-tip="New entry"
                            >
                                <button
                                    class="btn btn-ghost btn-circle bg-none px-1 hover:bg-transparent hover:border-transparent w-8 h-8 {notebook
                                        ? ''
                                        : 'disabled'}"
                                    onclick="newEntry_modal.showModal()"
                                >
                                    <i class="bi bi-plus-lg text-lg" />
                                </button>
                            </div>
                            <div class="">
                                <div class="dropdown dropdown-end">
                                    <label
                                        tabindex="-1"
                                        class="btn btn-circle btn-ghost bg-none px-1 hover:bg-transparent hover:border-transparent w-8 h-8"
                                        for=""
                                    >
                                        <i
                                            class="bi bi-three-dots-vertical text-lg"
                                        />
                                    </label>
                                    <ul
                                        tabindex="-1"
                                        class="dropdown-content menu p-1 bg-neutral shadow rounded w-40 gap-1"
                                    >
                                        <li>
                                            <button
                                                class="justify-start items-center no-underline capitalize px-2 py-1 hover:no-underline text-slate-900 dark:text-slate-50 {notebook
                                                    ? ''
                                                    : 'disabled'}"
                                                onclick="notebookSettings_modal.showModal()"
                                            >
                                                <i
                                                    class="bi bi-sliders2 text-lg"
                                                />
                                                <span
                                                    class="text-xs font-medium"
                                                    >Options</span
                                                >
                                            </button>
                                        </li>
                                        <li>
                                            <button
                                                class="justify-start items-center no-underline capitalize px-2 py-1 hover:no-underline text-error {notebook
                                                    ? ''
                                                    : 'disabled'}"
                                                onclick="deleteNotebook_modal.showModal()"
                                            >
                                                <i
                                                    class="bi bi-trash text-lg"
                                                />
                                                <span
                                                    class="text-xs font-medium"
                                                    >Remove</span
                                                >
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div
                                class="tooltip tooltip-bottom"
                                data-tip="Notebook settings"
                            />
                        </div>
                    </div>
                    <div class="">
                        <SearchForm />
                    </div>
                    <div class="w-full px-4 overflow-y-auto">
                        {#each notebook.entries as entry}
                            <button
                                class="btn-block text-left py-4 focus:outline-none {view !=
                                undefined
                                    ? entry.title === view.title
                                        ? 'text-black dark:text-white'
                                        : 'text-gray-700 dark:text-gray-300 hover:text-black hover:dark:text-white'
                                    : 'text-gray-700 dark:text-gray-300 hover:text-black hover:dark:text-white'}"
                                on:click={showEntry(entry.title)}
                            >
                                <div
                                    class="px-3 border-l-4 {view != undefined
                                        ? entry.title === view.title
                                            ? 'border-accent'
                                            : 'border-transparent'
                                        : 'border-transparent'}
							"
                                >
                                    <div class="text-xs opacity-60">
                                        {entry.created_at}
                                    </div>
                                    <div class="font-medium">{entry.title}</div>
                                </div>
                            </button>
                            <hr class="border-secondary border-opacity-50" />
                        {/each}
                    </div>
                </div>
            </div>
        </div>
        <div
            class="relative md:w-[65%] h-screen flex flex-col items-center ml-auto bg-neutral"
        >
            {#if view == undefined}
                <div class="w-full overflow-y-auto mt-16 px-16">Select</div>
            {:else}
                <div class="w-[70%] mb-2 fixed ml-auto">
                    <div
                        class="flex justify-between items-center h-12 px-16 border-b border-secondary border-opacity-50"
                    >
                        <div class="">
                            <span class="text-sm italic"
                                >{prettyDate(
                                    view.date,
                                    "yyyy-MM-dd",
                                    "EEEE, MMMM d, yyyy"
                                )}</span
                            >
                            <span class="mx-2">|</span>
                            <span
                                class="badge badge-accent text-white rounded font-black"
                                >{view.time}</span
                            >
                        </div>
                        <div class="">
                            <span
                                class="badge badge-secondary rounded font-black"
                                >tag</span
                            >
                        </div>
                    </div>
                </div>
                <div class="w-full overflow-y-auto mt-16 mb-4 pb-8 pt-4 px-16">
                    <div class="flex-col justify-center">
                        <h2 class="card-title text-2xl mb-6">
                            <span class="font-black">{view.title}</span>
                        </h2>

                        <div class="card-content">
                            <p class="leading-7" style="white-space: pre-wrap;">
                                {@html view.body}
                            </p>
                        </div>
                    </div>
                </div>
            {/if}
        </div>
    </div>
</main>

<Modal
    name="newNotebook_modal"
    title="Create notebook"
    classes="border-secondary w-9/12 md:w-6/12 lg:w-4/12 max-w-sm text-slate-900 dark:text-slate-50"
>
    <NewNotebookForm {categories} />
</Modal>

<Modal
    name="newEntry_modal"
    title="New entry"
    classes="border-secondary w-7/12 max-w-5xl text-slate-900 dark:text-slate-50"
>
    <NewEntryForm />
</Modal>

<Modal
    name="notebookSettings_modal"
    title="Notebook options"
    classes="border-secondary w-5/12 max-w-5xl text-slate-900 dark:text-slate-50"
>
    <NotebookSettingsForm />
</Modal>

<Modal
    name="appSettings_modal"
    title="Settings"
    classes="border-secondary w-5/12 max-w-5xl h-[400px] text-slate-900 dark:text-slate-50"
>
    <AppSettingsForm {notebooks} />
</Modal>

<Modal
    name="deleteNotebook_modal"
    title="Remove notebook"
    classes="border-secondary w-9/12 md:w-6/12 lg:w-4/12 max-w-sm text-slate-900 dark:text-slate-50"
>
    <RemoveNotebookForm {notebook} />
</Modal>

<style lang="postcss">
    :global(html) {
        background-color: gray;
    }
    /* width */
    ::-webkit-scrollbar {
        width: 4px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: transparent;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #f62a00;
        border-radius: 10px;
        display: none;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
        display: initial;
    }
</style>
