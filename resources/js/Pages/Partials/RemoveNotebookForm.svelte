<script>
    import { router } from "@inertiajs/svelte";

    export let notebook;

    let confirm = null;
    let confirmError = null;

    // Start processing state
    // Delete all entries for notebook (soft-delete, for restoration)
    // Delete notebook
    // Switch active notebook to last in array
    // Close modal
    const deleteNotebook = () => {
        if (confirm != null && confirm === notebook.name) {
            router.delete("/notebooks/" + notebook.id, {
                onSuccess: () => (confirm = ""),
                //onFinish: () => newEntryModal.close(),
            });
        } else if (confirm !== notebook.name) {
            confirmError == "The text you entered does not match";
        } else {
            confirmError == "Enter confirmation text to proceed";
        }
    };
</script>

<div class="flex flex-col lg:flex-row">
    <form on:submit|preventDefault={deleteNotebook} class="w-full">
        <div class="w-full px-4">
            <div class="form-control">
                <label
                    class="label flex-col items-start justify-start gap-2"
                    for="title"
                >
                    <span
                        class="label-text text-sm text-slate-900 dark:text-slate-100"
                        >Are you sure you want to remove this notebook and all
                        its entries? This action cannot be reversed</span
                    >
                    <span
                        class="label-text text-xs text-slate-900 dark:text-slate-200 font-medium"
                    >
                        Enter `{notebook.name}` to confirm:
                    </span>
                </label>
                <input
                    name="deleteConfirm"
                    type="text"
                    class="input input-sm bg-neutral placeholder-gray-500 rounded"
                    bind:value={confirm}
                />
                {#if confirmError !== null}
                    <label class="label" for="deleteConfirm">
                        <span class="label-text-alt text-error"
                            >{confirmError}</span
                        >
                    </label>
                {/if}
            </div>
        </div>
        <div class="flex gap-2 px-4 mt-3 mb-2">
            <input
                type="button"
                class="btn btn-success btn-ghost btn-sm max-xs:btn-block ml-auto text-xs rounded"
                value="Cancel"
            />
            <button
                class="btn btn-error btn-sm max-xs:btn-block text-white text-xs rounded"
                type="submit">Proceed</button
            >
        </div>
    </form>
</div>
