<script>
	import "../../css/app.css";
	import { useForm, router } from "@inertiajs/svelte";

	export let notebooks;
	export let categories;

	let search = "";
	let notebook = notebooks[0];
	let entry = {};
	let deleteConfirm = "";
	let appSettings = {
		accent: "",
		theme: "",
		spacing: "",
		sort: "",
	};

	let colors = ["red", "yellow", "blue", "green", "purple"];
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
	let fileImport = {
		file: null,
		notebook: 0,
	};

	const notebook_form = useForm({
		title: "",
		notebook_category_id: null,
	});
	const entry_form = {
		title: "",
		body: "",
		starred: false,
		notebook_id: null,
		created_at: Date.now(),
	};

	const listEntries = (id) => {
		notebook = notebooks.find((obj) => {
			return obj.id == id;
		});
	};
	const showIcon = (id) => {
		let cat = categories.find((o) => {
			return (o.id = id);
		});
		return cat.icon;
	};

	const submitNotebookForm = () => {
		console.log(notebook_form.title);
		console.log(notebook_form.notebook_category_id);
		// $notebook_form.post("/notebook");
		router.post("/notebooks", $notebook_form);
	};
	const submitEntryForm = () => {
		router.post("entries", entry_form);
	};
	const deleteNotebook = () => {};
	const handleSearch = () => {};
</script>

<main class="main relative text-slate-900 dark:text-slate-50">
	<div class="w-full flex">
		<div
			class="w-[5%] hidden sm:block h-screen border-r border-secondary bg-primary"
		>
			<div class="flex flex-col items-center justify-between h-full">
				<div class="flex flex-col items-center">
					<div class="flex flex-col items-center h-3 my-4">
						<!-- <button class="focus:outline-none">
							<i class="bi bi-card-heading text-lg" />
						</button> -->
						<img src="../../../logo.png" alt="Logo" class="w-14" />
					</div>
					<ul
						tabindex="-1"
						class="menu menu-compact w-full rounded-none items-center"
					>
						{#each notebooks as notebook}
							<li
								class="border-b border-secondary border-opacity-50"
							>
								<div
									class="md:tooltip md:tooltip-right"
									data-tip={notebook.name}
								>
									<button
										class="py-1"
										on:click={listEntries(notebook.id)}
									>
										<i
											class="bi bi-{showIcon(
												notebook.notebook_category_id
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
									class="text-accent py-1"
									onclick="new_notebook_modal.showModal()"
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
							onclick="app_settings_modal.showModal()"
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
									onclick="new_entry_modal.showModal()"
								>
									<i
										class="bi bi-file-earmark-plus text-lg"
									/>
								</button>
							</div>
							<div class="">
								<div class="dropdown dropdown-end">
									<label
										tabindex="-1"
										class="btn btn-circle btn-ghost bg-none px-1 hover:bg-transparent hover:border-transparent w-8 h-8"
										for=""
									>
										<i class="bi bi-three-dots text-lg" />
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
												onclick="notebook_settings_modal.showModal()"
											>
												<i
													class="bi bi-sliders2 text-lg"
												/>
												<span
													class="text-sm font-medium"
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
													class="text-sm font-medium"
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
						<div class="" />
					</div>
					<form
						class="py-1 border-b border-secondary border-opacity-50"
						action=""
					>
						<div class="flex items-center">
							<span
								class="ml-5 text-slate-500 dark:text-slate-300"
							>
								<i class="bi bi-search text-xs" />
							</span>
							<input
								type="search"
								name="search"
								id="search"
								placeholder="Search..."
								class="w-full input input-md bg-transparent rounded-none border-none pl-3 focus:outline-0 focus:ring-0 placeholder:text-slate-500 dark:placeholder:text-slate-300"
								bind:value={search}
								on:keyup={handleSearch}
							/>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div
			class="relative md:w-[65%] h-screen flex flex-col items-center ml-auto bg-neutral"
		/>
	</div>
</main>

<dialog id="new_notebook_modal" class="modal">
	<form
		method="dialog"
		class="modal-box border border-secondary rounded bg-primary p-0 w-9/12 md:w-6/12 lg:w-4/12 max-w-sm text-slate-900 dark:text-slate-50"
	>
		<button
			for="new_notebook_modal"
			class="btn btn-sm btn-circle btn-ghost absolute right-2 top-1"
			>✕</button
		>
		<div class="flex flex-col lg:flex-row">
			<form on:submit|preventDefault={submitNotebookForm} class="w-full">
				<div class="py-3 md:py-3 lg:py-2">
					<h3
						class="text-sm font-semibold leading-none lg:mt-1 px-3 md:px-4"
					>
						Add Notebook
					</h3>
					<hr
						class="w-full border border-secondary border-opacity-50 my-2 mr-auto"
					/>
					<div class="w-full max-w-sm px-2 md:px-3 md:mx-auto">
						<div class="md:flex md:items-center mb-4">
							<div class="w-full md:w-1/3">
								<label
									class="label font-medium py-2"
									for="title"
								>
									<span
										class="label-text text-xs text-slate-900 dark:text-slate-50"
										>Title:</span
									>
								</label>
							</div>
							<div class="w-full md:w-2/3">
								<input
									type="text"
									class="input input-sm bg-neutral placeholder-gray-500 rounded-md w-full"
									bind:value={notebook_form.title}
								/>
								{#if $notebook_form.errors.title}
									<label class="label" for="title">
										<span class="label-text-alt text-error"
											>{$notebook_form.errors.title}</span
										>
									</label>
								{/if}
							</div>
						</div>
						<div class="md:flex md:items-center mb-4">
							<div class="w-full md:w-1/3">
								<label
									class="label font-medium py-2"
									for="icon"
								>
									<span
										class="label-text text-xs text-slate-900 dark:text-slate-50"
										>Category:</span
									>
								</label>
							</div>
							<div class="w-full md:w-2/3">
								<select
									class="select select-sm bg-neutral placeholder-gray-500 rounded-md w-full"
									bind:value={notebook_form.notebook_category_id}
								>
									<option
										disabled
										selected
										class="text-gray-200">Select</option
									>
									{#each categories as category}
										<option value={category.id}>
											{category.name}
										</option>
									{/each}
								</select>
								{#if $notebook_form.errors.notebook_category_id}
									<label class="label" for="category">
										<span class="label-text-alt text-error"
											>{$notebook_form.errors
												.notebook_category_id}</span
										>
									</label>
								{/if}
							</div>
						</div>

						<div class="flex gap-2 mt-3">
							<button
								class="btn btn-neutral btn-ghost btn-sm max-xs:btn-block ml-auto text-xs rounded"
								>Cancel</button
							>
							<button
								class="btn btn-accent btn-sm max-xs:btn-block text-white text-xs rounded"
								type="submit"
								disabled={$notebook_form.processing}
								>Save</button
							>
						</div>
					</div>
				</div>
			</form>
		</div>
	</form>
	<form method="dialog" class="modal-backdrop">
		<button>close</button>
	</form>
</dialog>

<dialog id="new_entry_modal" class="modal">
	<form
		method="dialog"
		class="modal-box border border-secondary rounded bg-primary p-0 w-10/12 max-w-5xl"
	>
		<button
			for="new_entry_modal"
			class="btn btn-sm btn-circle btn-ghost absolute right-1 top-1"
			>✕</button
		>
		<form on:submit|preventDefault={submitEntryForm}>
			<div
				class="flex flex-col lg:flex-row text-slate-900 dark:text-slate-50"
			>
				<div class="w-full lg:w-2/5">
					<div class="flex flex-col items-start pt-12 md:py-3">
						<h3 class="text-sm leading-none font-semibold px-6">
							New Entry
						</h3>
						<hr
							class="w-full border border-secondary border-opacity-50 my-2 mr-auto"
						/>
						<div class="w-full px-4">
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
				</div>
				<div
					class="w-full lg:w-3/5 lg:border-l border-secondary border-opacity-50"
				>
					<div class="flex flex-col md:pb-3 md:pt-2 lg:px-4">
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
								:disabled="notebook_form.processing"
								>Save</button
							>
						</div>
					</div>
				</div>
			</div>
		</form>
	</form>
	<form method="dialog" class="modal-backdrop">
		<button>close</button>
	</form>
</dialog>

<dialog
	id="notebook_settings_modal"
	class="modal text-slate-900 dark:text-slate-50"
>
	<form
		method="dialog"
		class="modal-box border border-secondary rounded bg-primary p-2 w-5/12 max-w-5xl"
	>
		<button
			for="notebook_settings_modal"
			class="btn btn-sm btn-circle btn-ghost absolute right-1 top-0"
			>✕</button
		>
		<div class="">
			<h3 class="text-base font-bold mb-2">Notebook Settings</h3>
		</div>
		<div
			class="flex flex-col lg:flex-row text-slate-900 dark:text-slate-50"
		>
			<fieldset
				class="border border-solid border-gray-300 p-3 w-3/5 mx-auto"
			>
				<legend class="text-xs uppercase">Appearance:</legend>
				<div class="form-control">
					<label class="label cursor-pointer gap-2">
						<span
							class="label-text text-slate-900 dark:text-slate-50 mr-20"
							>Color</span
						>
						<input
							type="radio"
							name="radio-10"
							class="radio radio-error"
							checked
						/>
						<input
							type="radio"
							name="radio-10"
							class="radio radio-info"
						/>
						<input
							type="radio"
							name="radio-10"
							class="radio radio-success"
						/>
						<input
							type="radio"
							name="radio-10"
							class="radio radio-accent"
						/>
						<input
							type="radio"
							name="radio-10"
							class="radio radio-warning"
						/>
					</label>
				</div>

				<div class="">
					<span
						class="label-text text-slate-900 dark:text-slate-50 mb-2"
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
		</div>
	</form>
	<form method="dialog" class="modal-backdrop">
		<button>close</button>
	</form>
</dialog>

<dialog id="app_settings_modal" class="modal text-slate-900 dark:text-slate-50">
	<form
		method="dialog"
		class="modal-box border border-secondary rounded bg-primary px-4 py-2 w-5/12 max-w-5xl"
	>
		<button
			for="app_settings_modal"
			class="btn btn-sm btn-circle btn-ghost absolute right-1 top-1"
		>
			<i class="bi bi-x-circle text-lg" />
		</button>
		<div class="">
			<h3 class="text-base font-bold mb-2">Settings</h3>
		</div>
		<div class="flex flex-col text-slate-900 dark:text-slate-50">
			<fieldset
				class="border border-secondary border-opacity-50 px-4 py-2 mx-auto my-2 w-full"
			>
				<legend class="text-xs uppercase font-bold">Profile</legend>
				<div class="flex flex-row">
					<div class="w-1/5 pt-4 px-2 flex flex-col items-center">
						<div class="">
							<i class="bi bi-person-circle text-5xl" />
						</div>
						<div class="my-2">
							<button
								class="btn btn-ghost btn-link bg-none btn-xs texs-xs capitalize font-normal rounded"
								>edit</button
							>
						</div>
					</div>
					<div class="w-4/5 p-2">
						<div class="md:flex md:items-center mb-1">
							<div class="w-full md:w-1/6">
								<label
									class="label font-medium py-2"
									for="name"
								>
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
								<label
									class="label font-medium py-2"
									for="email"
								>
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
			</fieldset>
			<fieldset
				class="border border-secondary border-opacity-50 p-3 w-full mx-auto my-2"
			>
				<legend class="text-xs uppercase font-bold">Appearance</legend>
				<div class="md:flex md:items-start md:gap-2">
					<div class="w-full md:w-1/2">
						<fieldset
							class="border border-secondary border-opacity-50 p-2 mx-auto"
						>
							<legend class="text-xs capitalize font-bold"
								>Theme</legend
							>
							<div class="form-control">
								<label
									class="label font-medium py-2"
									for="title"
								>
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
											>{theme == "system"
												? "Follow system"
												: theme}</option
										>
									{/each}
								</select>
							</div>
						</fieldset>
						<fieldset
							class="border border-secondary border-opacity-50 p-2 mx-auto mt-2"
						>
							<legend class="text-xs capitalize font-bold"
								>Spacing</legend
							>
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
											<label
												for="radio-{space}"
												class="label ml-2 w-full"
											>
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
						<fieldset
							class="border border-secondary border-opacity-50 p-2 mx-auto"
						>
							<legend class="text-xs capitalize font-bold"
								>Sort options</legend
							>
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
			</fieldset>

			<form action="">
				<fieldset
					class="border border-secondary border-opacity-50 p-3 w-full my-2"
				>
					<legend class="text-xs uppercase font-bold"
						>Backup & Import</legend
					>
					<fieldset
						class="border border-secondary border-opacity-50 py-1 px-2 mx-auto"
					>
						<legend class="text-xs capitalize font-bold"
							>Import entries</legend
						>
						<div
							class="flex items-center justify-center w-full max-w-lg mt-3 mb-2"
						>
							<label
								for="dropzone-file"
								class="flex flex-col items-center justify-center w-full h-24 cursor-pointer bg-neutral hover:bg-secondary"
							>
								{#if fileImport.file != null}
									<div class="">
										<label
											class="label font-medium py-2"
											for="title"
										>
											<span
												class="label-text text-xs text-slate-900 dark:text-slate-50 mr-20"
												>Import file</span
											>
										</label>
										<p>{fileImport.file}</p>
									</div>
								{:else}
									<div
										class="flex flex-col items-center justify-center py-4 border-2 border-secondary border-opacity-50 border-dashed rounded hover:border-neutral w-full"
									>
										<i class="bi bi-cloud-upload" />
										<p
											class="mb-2 text-sm text-gray-500 dark:text-gray-400"
										>
											<span class="font-semibold"
												>Click to upload</span
											> or drag and drop
										</p>
										<p
											class="text-xs text-gray-500 dark:text-gray-400"
										>
											JSON, XML, or MD files (jrnl
											exports)
										</p>
									</div>
								{/if}

								<input
									id="dropzone-file"
									type="file"
									class="hidden"
									accept=".txt,.md,.json"
									autocomplete="off"
									bind:value={fileImport.file}
								/>
							</label>
						</div>
						<div class="md:flex md:items-center mb-4">
							<div class="w-full md:w-1/3">
								<label
									class="label font-medium py-2"
									for="title"
								>
									<span
										class="label-text text-xs text-slate-900 dark:text-slate-50 mr-20"
										>To notebook:</span
									>
								</label>
							</div>
							<div class="w-full md:w-2/3">
								<select
									class="select select-sm bg-neutral placeholder-gray-500 rounded-md w-full"
									bind:value={fileImport.notebook}
								>
									<option value="0" class="py-1" selected
										>Create new</option
									>
									<hr
										class="py-1 border border-secondary border-opacity-80"
									/>
									{#each notebooks as notebook}
										<option value={notebook.id} class="py-1"
											>{notebook.name}</option
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
								disabled={$notebook_form.processing}
								value="Save"
							/>
						</div>
					</fieldset>
					<div class="my-2">
						<button
							class="btn btn-secondary btn-block ml-auto text-xs rounded justify-between capitalize"
						>
							<span>Export notes</span>
							<span
								><i class="bi bi-chevron-right text-sm" /></span
							>
						</button>
					</div>
				</fieldset>
			</form>
		</div>
	</form>
	<form method="dialog" class="modal-backdrop">
		<button>close</button>
	</form>
</dialog>

<dialog id="deleteNotebook_modal" class="modal">
	<form
		method="dialog"
		class="modal-box border border-secondary rounded bg-primary p-0 w-9/12 md:w-6/12 lg:w-4/12 max-w-sm text-slate-900 dark:text-slate-50"
	>
		<button
			for="deleteNotebook_modal"
			class="btn btn-sm btn-circle btn-ghost absolute right-2 top-1"
			>✕</button
		>
		<div class="flex flex-col lg:flex-row">
			<form on:submit|preventDefault={deleteNotebook} class="w-full">
				<div class="py-3 md:py-3 lg:py-2">
					<h3
						class="text-sm font-semibold leading-none lg:mt-1 px-3 md:px-4"
					>
						Remove Notebook
					</h3>
					<hr
						class="w-full border border-secondary border-opacity-50 my-2 mr-auto"
					/>
					<div class="w-full px-4">
						<div class="form-control">
							<label
								class="label flex-col items-start justify-start gap-2"
								for="title"
							>
								<span
									class="label-text text-sm text-slate-900 dark:text-slate-100"
									>Are you sure you want to remove this
									notebook and all its entries? This action
									cannot be reversed</span
								>
								{#if notebook}
									<span
										class="label-text text-xs text-slate-900 dark:text-slate-200 font-medium"
									>
										Enter `{notebook.name}` to confirm:
									</span>
								{/if}
							</label>
							<input
								type="text"
								class="input input-sm bg-neutral placeholder-gray-500 rounded"
								bind:value={deleteConfirm}
							/>
						</div>
					</div>
					<div class="flex gap-2 px-4 mt-3 mb-2">
						<button
							class="btn btn-success btn-ghost btn-sm max-xs:btn-block ml-auto text-xs rounded"
							>Cancel</button
						>
						<button
							class="btn btn-error btn-sm max-xs:btn-block text-white text-xs rounded"
							type="submit">Proceed</button
						>
					</div>
				</div>
			</form>
		</div>
	</form>
	<form method="dialog" class="modal-backdrop">
		<button>close</button>
	</form>
</dialog>

<style lang="postcss">
	:global(html) {
		background-color: gray;
	}
	textarea {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		width: 100%;
	}
	.select {
		font-weight: initial;
	}
</style>
