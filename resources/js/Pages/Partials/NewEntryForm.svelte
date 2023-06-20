<script>
    import { useForm } from "@inertiajs/svelte";
    import { format } from "date-fns";

    export let notebook_id;

    const entryForm = useForm({
        title: "",
        body: "",
        notebook_id: notebook_id,
        tags: [],
        created_at: format(Date.now(), "yyyy-MM-dd hh:mm:ss"),
    });

    let tag;
    const addTag = (e) => {
        if (!$entryForm.tags.includes(e.target.value))
            $entryForm.tags.push(e.target.value);
        $entryForm.tags = $entryForm.tags;
        tag = "";
    };
    const delTag = (e) => {
        $entryForm.tags = $entryForm.tags.filter((v) => {
            return v !== e;
        });
        $entryForm.tags = $entryForm.tags;
        tag = "";
    };

    // Entry forms:
    // richtext (journal, notes, list, code)
    // simplified (quicknotes, snippets)

    const submitEntryForm = () => {
        console.log(notebook_id);
        $entryForm.post("entries", {});
    };
</script>

<form on:submit|preventDefault={submitEntryForm}>
    <div class="flex flex-col lg:flex-row text-slate-900 dark:text-slate-50">
        <div class="flex flex-col items-start w-full lg:w-2/5 lg:pr-2">
            <div class="w-full">
                <div class="form-control">
                    <label class="label font-medium" for="title">
                        <span
                            class="label-text text-xs text-slate-900 dark:text-slate-50"
                            >Title</span
                        >
                    </label>
                    <input
                        type="text"
                        class="input input-sm bg-neutral placeholder-gray-500 rounded"
                        bind:value={$entryForm.title}
                    />
                    {#if $entryForm.errors.title}
                        <label class="label" for="category">
                            <span class="label-text-alt text-error"
                                >{$entryForm.errors.title}</span
                            >
                        </label>
                    {/if}
                </div>
                <div class="form-control">
                    <label class="label font-medium" for="date">
                        <span
                            class="label-text text-xs text-slate-900 dark:text-slate-50"
                            >Date</span
                        >
                    </label>
                    <input
                        type="datetime"
                        class="input input-sm bg-neutral placeholder-gray-500 rounded"
                        bind:value={$entryForm.created_at}
                    />
                    {#if $entryForm.errors.created_at}
                        <label class="label" for="category">
                            <span class="label-text-alt text-error"
                                >{$entryForm.errors.created_at}</span
                            >
                        </label>
                    {/if}
                </div>
                <div class="form-control">
                    <label class="label font-medium" for="company">
                        <span
                            class="label-text text-xs text-slate-900 dark:text-slate-50"
                            >Tags</span
                        >
                    </label>
                    <div
                        class="inline-flex flex-wrap items-center gap-1 text-xs border-2 border-secondary border-opacity-60 p-1"
                    >
                        {#if $entryForm.tags !== null}
                            <div class="inline-flex flex-wrap gap-1">
                                {#each $entryForm.tags as tg}
                                    <div
                                        class="badge badge-secondary badge-lg text-sm relative rounded group px-1"
                                    >
                                        <span class="">{tg}</span>
                                        <!-- svelte-ignore a11y-click-events-have-key-events -->
                                        <span
                                            class="text-white ml-1"
                                            on:click={delTag(tg)}
                                        >
                                            <i class="bi bi-x" />
                                        </span>
                                    </div>
                                {/each}
                            </div>
                        {/if}
                        <div class="w-auto">
                            <input
                                type="text"
                                class="input input-sm border-none bg-primary placeholder-gray-500 rounded"
                                bind:value={tag}
                                on:change={addTag}
                            />
                        </div>
                    </div>

                    {#if $entryForm.errors.tags}
                        <label class="label" for="category">
                            <span class="label-text-alt text-error"
                                >{$entryForm.errors.tags}</span
                            >
                        </label>
                    {/if}
                </div>
                <div class="form-control">
                    <label class="label font-medium" for="notebook">
                        <span
                            class="label-text text-xs text-slate-900 dark:text-slate-50"
                            >Notebook</span
                        >
                    </label>
                    <input
                        type="text"
                        class="input input-sm bg-neutral placeholder-gray-500 rounded"
                        placeholder={notebook_id}
                    />
                </div>
            </div>
        </div>
        <div
            class="w-full lg:w-3/5 lg:border-l lg:pl-2 border-secondary border-opacity-50"
        >
            <div class="flex flex-col">
                <div class="form-control">
                    <label class="label font-medium pt-1" for="message">
                        <span
                            class="label-text text-xs text-slate-900 dark:text-slate-50"
                            >What on your mind?</span
                        >
                    </label>
                    <textarea
                        rows="16"
                        cols="70"
                        class="textarea bg-neutral placeholder-gray-500 rounded"
                        bind:value={$entryForm.body}
                    />
                    {#if $entryForm.errors.body}
                        <label class="label" for="category">
                            <span class="label-text-alt text-error"
                                >{$entryForm.errors.body}</span
                            >
                        </label>
                    {/if}
                </div>
                <div class="flex justify-end gap-2 mt-3">
                    <input
                        class="btn btn-neutral btn-ghost btn-sm max-xs:btn-block ml-auto text-xs rounded"
                        type="button"
                        value="Cancel"
                        onclick="newEntryModal.close()"
                    />
                    <button
                        class="btn btn-accent btn-sm max-xs:btn-block text-white text-xs rounded"
                        type="submit"
                        :disabled="entryForm.processing">Save</button
                    >
                </div>
            </div>
        </div>
    </div>
</form>
