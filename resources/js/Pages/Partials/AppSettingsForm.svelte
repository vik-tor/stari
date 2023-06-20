<script>
	import { useForm } from "@inertiajs/svelte";

	import { Tab, Tabs, TabList, TabPanel } from "../../Components/Tabs";

	let selectedId = "first";

	export let notebooks;

	let appSettings = {
		accent: "",
		theme: "",
		spacing: "",
		sort: "",
	};

	let spacing = ["comfortable", "normal", "condensed"];
	let sorting = [
		"name_asc",
		"name_desc",
		"created_asc",
		"created_desc",
		"modified_asc",
		"modified_desc",
	];
	let themes = ["system", "light", "dark"];
	let importForm = useForm({
		upload: null,
		notebook_id: null,
	});

	const uploadFile = () => {
		$importForm.post("import", {
			onSuccess: () => newEntryModal.close(),
			onFinish: () => $importForm.reset("upload", "notebook_id"),
		});
	};
</script>

<Tabs {selectedId}>
	<TabList>
		<Tab id="first"><div class="mb-1">Profile</div></Tab>
		<Tab id="second"><div class="mb-1">Appearance</div></Tab>
		<Tab id="third"><div class="mb-1">Data</div></Tab>
	</TabList>

	<hr class="w-full border border-secondary border-opacity-50" />

	<!-- Make heading + tab list fixed, tab panel overflow -->
	<TabPanel id="first">
		<!-- Edit & delete profile, log out -->
		<div class="flex flex-col w-4/5 items-center mx-auto">
			<div class="py-4 flex items-center">
				<div class="">
					<i class="bi bi-person-circle text-5xl" />
				</div>
				<div class="mx-2">
					<button
						class="btn btn-ghost btn-link bg-none btn-xs texs-xs capitalize font-normal rounded text-base-100"
						>Edit</button
					>
				</div>
			</div>
			<div class="w-full p-2">
				<div class="md:flex md:items-center mb-1">
					<div class="w-full md:w-1/6">
						<label class="label font-medium py-2" for="name">
							<span
								class="label-text text-xs text-slate-900 dark:text-slate-50 mr-20"
								>Name:</span
							>
						</label>
					</div>
					<div class="w-full md:w-5/6">
						<input
							type="text"
							placeholder="John Doe"
							class="input input-sm bg-neutral placeholder-gray-900 dark:placeholder-gray-50 rounded w-full"
						/>
					</div>
				</div>
				<div class="md:flex md:items-center mb-1">
					<div class="w-full md:w-1/6">
						<label class="label font-medium py-2" for="email">
							<span
								class="label-text text-xs text-slate-900 dark:text-slate-50 mr-20"
								>Email:</span
							>
						</label>
					</div>
					<div class="w-full md:w-5/6">
						<input
							type="email"
							placeholder="john.doe@email.com"
							class="input input-sm bg-neutral placeholder-gray-900 dark:placeholder-gray-50 rounded w-full"
						/>
					</div>
				</div>
				<div class="flex mt-2 justify-end">
					<button
						class="btn btn-accent btn-xs texs-xs capitalize font-medium rounded"
						>Save</button
					>
				</div>
			</div>
		</div>
		<div class="w-4/5 mx-auto my-4">
			<button
				class="btn btn-accent btn-block btn-sm ml-auto text-xs text-base-100 rounded justify-between capitalize"
			>
				<span>Log Out</span>
				<span><i class="bi bi-box-arrow-up-right text-sm" /></span>
			</button>
		</div>
	</TabPanel>

	<TabPanel id="second">
		<div class="md:flex md:items-start md:gap-2">
			<div class="w-full md:w-1/2">
				<fieldset class="border border-secondary border-opacity-50 p-2 mx-auto">
					<legend class="text-xs capitalize font-bold">Theme</legend>
					<div class="form-control">
						<label class="label font-medium py-2" for="title">
							<span
								class="label-text text-xs text-slate-900 dark:text-slate-50 mr-20"
								>System theme:</span
							>
						</label>
						<select
							class="select select-sm bg-neutral placeholder-gray-500 rounded-md w-full"
							bind:value={appSettings.theme}
						>
							<option value="">Select</option>
							{#each themes as theme}
								<option value={theme} class="capitalize"
									>{theme == "system" ? "Follow system" : theme}</option
								>
							{/each}
						</select>
					</div>
				</fieldset>
				<fieldset
					class="border border-secondary border-opacity-50 p-2 mx-auto mt-2"
				>
					<legend class="text-xs capitalize font-bold">Spacing</legend>
					<ul class="radio-group w-full">
						{#each spacing as space}
							<li class="w-full">
								<div class="flex items-center pl-3">
									<input
										id="radio-{space}"
										type="radio"
										value={space}
										name="spacing"
										class="radio-secondary"
										bind:group={appSettings.spacing}
									/>
									<label for="radio-{space}" class="label ml-2 w-full">
										<span
											class="label-text text-xs capitalize text-slate-900 dark:text-slate-50"
											>{space}</span
										>
									</label>
								</div>
							</li>
						{/each}
					</ul>
				</fieldset>
			</div>
			<div class="w-full md:w-1/2">
				<fieldset class="border border-secondary border-opacity-50 p-2 mx-auto">
					<legend class="text-xs capitalize font-bold">Sort options</legend>
					<ul class="radio-group w-full">
						{#each sorting as sort}
							<li class="w-full">
								<div class="flex items-center pl-3">
									<input
										id="radio-{sort}"
										type="radio"
										value={sort}
										name="sorting"
										class="radio-secondary"
										bind:group={appSettings.sort}
									/>
									<label
										for="radio-{sort}"
										class="label font-medium ml-2 w-full"
									>
										<span
											class="label-text text-xs capitalize text-slate-900 dark:text-slate-50"
											>{sort}</span
										>
									</label>
								</div>
							</li>
						{/each}
					</ul>
				</fieldset>
			</div>
		</div>
	</TabPanel>

	<TabPanel id="third">
		<form on:submit|preventDefault={uploadFile} class="w-4/5 mx-auto">
			<fieldset
				class="border border-secondary border-opacity-50 py-1 px-2 mx-auto"
			>
				<legend class="text-xs capitalize font-bold">Import notes</legend>
				<div class="flex flex-col justify-center w-full max-w-lg mt-3 mb-2">
					{#if $importForm.upload == null}
						<div class="mb-1">
							<small class="text-xs">
								Accepted formats: jrnl JSON, MD, and TXT exports
							</small>
						</div>
					{/if}
					<label
						for="dropzone-file"
						class="w-full cursor-pointer bg-neutral hover:bg-secondary"
					>
						{#if $importForm.upload != null}
							<div class="flex flex-col justify-start text-xs p-2">
								<span class="font-semibold">Import file</span>
								<hr class="border border-secondary my-1" />
								<p>{$importForm.upload.name}</p>
							</div>
						{:else}
							<div
								class="flex flex-col h-20 items-center justify-center border-2 border-secondary border-opacity-50 border-dashed rounded hover:border-neutral w-full"
							>
								<i class="bi bi-cloud-upload" />
								<p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
									<span class="font-semibold">Click to upload</span> or drag and
									drop
								</p>
							</div>
						{/if}

						<input
							id="dropzone-file"
							type="file"
							class="hidden"
							accept=".txt,.md,.json"
							autocomplete="off"
							on:input={(e) => ($importForm.upload = e.target.files[0])}
						/>
					</label>
					{#if $importForm.progress}
						<progress
							value={$importForm.progress.percentage}
							max="100"
							class="progress progress-accent w-full my-1"
						>
							{$importForm.progress.percentage}%
						</progress>
					{/if}
					{#if $importForm.errors.upload}
						<label class="label" for="category">
							<span class="label-text-alt text-error"
								>{$importForm.errors.upload}</span
							>
						</label>
					{/if}
				</div>
				<div class="md:flex md:items-center mb-4">
					<div class="w-full md:w-1/3">
						<label class="label font-medium py-2" for="title">
							<span
								class="label-text text-xs text-slate-900 dark:text-slate-50 mr-20"
								>Notebook:</span
							>
						</label>
					</div>
					<div class="w-full md:w-2/3">
						<select
							class="select select-sm bg-neutral placeholder-gray-500 rounded-md w-full"
							bind:value={$importForm.notebook_id}
						>
							<option value="0" class="py-1" selected>Create new</option>
							<hr class="py-1 border border-secondary border-opacity-80" />
							{#each notebooks as notebook}
								<option value={notebook.id} class="py-1">{notebook.name}</option
								>
							{/each}
						</select>
					</div>
				</div>
				<div class="flex gap-2 mt-3 mb-2">
					<input
						class="btn btn-neutral btn-ghost btn-xs ml-auto text-xs rounded capitalize font-medium"
						type="reset"
						value="Clear"
					/>
					<input
						class="btn btn-accent btn-xs text-white text-xs rounded capitalize font-medium"
						type="submit"
						value="Save"
					/>
				</div>
			</fieldset>
		</form>
		<div class="w-4/5 mx-auto my-4">
			<button
				class="btn btn-secondary btn-block btn-sm ml-auto text-xs text-base-100 rounded justify-between capitalize"
			>
				<span>Export notes</span>
				<span><i class="bi bi-box-arrow-up-right text-sm" /></span>
			</button>
		</div>
	</TabPanel>
</Tabs>
