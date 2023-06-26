<script>
	import { useForm } from "@inertiajs/svelte";

	const notebookForm = useForm({
		name: "",
		notebook_category_id: null,
	});
	const submitNotebookForm = () => {
		$notebookForm.post("/notebooks", {
			preserveScroll: true,
			onSuccess: () => newEntryModal.close(),
			onFinish: () => $notebookForm.reset("title"),
			onError: () => {
				if ($notebookForm.errors.name) {
					$notebookForm.reset("name");
				}
				if ($notebookForm.errors.notebook_category_id) {
					$notebookForm.reset("notebook_category_id");
				}
			},
		});
	};
</script>

<div class="flex flex-col lg:flex-row text-slate-900 dark:text-slate-50">
	<fieldset class="border border-solid border-gray-300 p-3 w-3/5 mx-auto">
		<legend class="text-xs uppercase">Appearance:</legend>
		<div class="form-control">
			<label class="label cursor-pointer gap-2">
				<span class="label-text text-slate-900 dark:text-slate-50 mr-20"
					>Color</span
				>
				<input type="radio" name="radio-10" class="radio radio-error" checked />
				<input type="radio" name="radio-10" class="radio radio-info" />
				<input type="radio" name="radio-10" class="radio radio-success" />
				<input type="radio" name="radio-10" class="radio radio-accent" />
				<input type="radio" name="radio-10" class="radio radio-warning" />
			</label>
		</div>

		<div class="">
			<span class="label-text text-slate-900 dark:text-slate-50 mb-2"
				>Spacing</span
			>
			<div class="join join-vertical w-full rounded bg-inherit">
				<input
					class="join-item btn btn-sm text-sm font-normal capitalize justify-start"
					type="radio"
					name="options"
					aria-label="Comfy"
				/>
				<input
					class="join-item btn btn-sm text-sm font-normal capitalize justify-start"
					type="radio"
					name="options"
					aria-label="Normal"
				/>
				<input
					class="join-item btn btn-sm text-sm font-normal capitalize justify-start"
					type="radio"
					name="options"
					aria-label="Condensed"
				/>
			</div>
		</div>
	</fieldset>
	<form on:submit|preventDefault={submitNotebookForm} class="w-full">
		<div class="w-full max-w-sm px-2 md:px-3 md:mx-auto">
			<div class="md:flex md:items-center mb-4">
				<div class="w-full md:w-1/3">
					<label class="label font-medium py-2" for="title">
						<span class="label-text text-xs text-slate-900 dark:text-slate-50"
							>Title:</span
						>
					</label>
				</div>
				<div class="w-full md:w-2/3">
					<input
						type="text"
						class="input input-sm bg-neutral placeholder-gray-500 rounded-md w-full"
						bind:value={$notebookForm.name}
					/>
					{#if $notebookForm.errors.name}
						<label class="label" for="notebookName">
							<span class="label-text-alt text-error"
								>{$notebookForm.errors.name}</span
							>
						</label>
					{/if}
				</div>
			</div>
			<div class="md:flex md:items-center mb-4">
				<div class="w-full md:w-1/3">
					<label class="label font-medium py-2" for="icon">
						<span class="label-text text-xs text-slate-900 dark:text-slate-50"
							>Category:</span
						>
					</label>
				</div>
				<div class="w-full md:w-2/3">
					<select
						class="select select-sm bg-neutral placeholder-gray-500 rounded-md w-full"
						bind:value={$notebookForm.notebook_category_id}
					>
						<option disabled selected class="text-gray-200">Select</option>
						{#each categories as category}
							<option value={category.id}>
								{category.name}
							</option>
						{/each}
					</select>
					{#if $notebookForm.errors.notebook_category_id}
						<label class="label" for="category">
							<span class="label-text-alt text-error"
								>{$notebookForm.errors.notebook_category_id}</span
							>
						</label>
					{/if}
				</div>
			</div>

			<div class="flex gap-2 mt-3">
				<input
					class="btn btn-neutral btn-ghost btn-sm max-xs:btn-block ml-auto text-xs rounded"
					type="button"
					value="Cancel"
					onclick="newNotebookModal.close()"
				/>
				<button
					class="btn btn-accent btn-sm max-xs:btn-block text-white text-xs rounded"
					type="submit"
					disabled={$notebookForm.processing}>Save</button
				>
			</div>
		</div>
	</form>
</div>
