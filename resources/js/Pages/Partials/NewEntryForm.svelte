<script>
    import { useForm } from "@inertiajs/svelte";

    const entryForm = useForm({
        title: "",
        body: "",
        starred: false,
        notebook_id: null,
        created_at: Date.now(),
    });

    // Entry forms:
    // richtext (journal, notes, list, code)
    // simplified (quicknotes, snippets)

    const submitEntryForm = () => {
        router.post("entries", entryForm);
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
                    />
                </div>
                <div class="form-control">
                    <label class="label font-medium" for="date">
                        <span
                            class="label-text text-xs text-slate-900 dark:text-slate-50"
                            >Date</span
                        >
                    </label>
                    <input
                        type="datetime-local"
                        value=""
                        class="input input-sm bg-neutral placeholder-gray-500 rounded"
                    />
                </div>
                <div class="form-control">
                    <label class="label font-medium" for="company">
                        <span
                            class="label-text text-xs text-slate-900 dark:text-slate-50"
                            >Tags</span
                        >
                    </label>
                    <input
                        type="text"
                        class="input input-sm bg-neutral placeholder-gray-500 rounded"
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
                    />
                </div>
                <div class="flex justify-end gap-2 mt-3">
                    <button
                        class="btn btn-neutral btn-ghost btn-sm max-xs:btn-block ml-auto text-xs rounded"
                        >Cancel</button
                    >
                    <button
                        class="btn btn-accent btn-sm max-xs:btn-block text-white text-xs rounded"
                        :disabled="notebookForm.processing">Save</button
                    >
                </div>
            </div>
        </div>
    </div>
</form>
