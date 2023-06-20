<script>
	import "../../css/app.css";
	//import Modal from "../Components/Modal.svelte";
	import AppSettingsForm from "./Partials/AppSettingsForm.svelte";
	import NewEntryForm from "./Partials/NewEntryForm.svelte";
	import NewNotebookForm from "./Partials/NewNotebookForm.svelte";
	import NotebookSettingsForm from "./Partials/NotebookSettingsForm.svelte";
	import RemoveNotebookForm from "./Partials/RemoveNotebookForm.svelte";
	import SearchForm from "./Partials/SearchForm.svelte";

	import { Modal, Content, Trigger } from "../Components/Modal";

	import { format, parse } from "date-fns";

	export let notebooks;
	export let categories;

	let closeModal = false;
	let notebook = notebooks[0];
	let view = null;
	let newEntry = {
		title: "Title",
		body: "",
		notebook_id: notebook.id,
		tags: [],
		created_at: format(Date.now(), "yyyy-MM-dd hh:mm:ss"),
	};

	const listEntries = (id) => {
		notebook = notebooks.find((obj) => {
			return obj.id == id;
		});
		notebook = notebook;
	};
	const showEntry = (id) => {
		view = notebook.entries.find((o) => {
			return o.id === id;
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
					<!-- <div class="flex flex-col items-center h-3 my-4">
                        <button class="focus:outline-none">
                            <i class="bi bi-card-heading text-lg" />
                        </button>
                        <img src="../../../logo.png" alt="Logo" class="w-4" />
                    </div> -->
					<div class="flex flex-col w-full items-center">
						{#each notebooks as nb}
							<button
								class="border-b border-primary border-opacity-50 px-2 py-3 mb-1"
								on:click={listEntries(nb.id)}
							>
								<div class="md:tooltip md:tooltip-right" data-tip={nb.name}>
									<span
										class={nb.id == notebook.id
											? "text-accent"
											: "text-gray-700 dark:text-slate-400 hover:text-black hover:dark:text-white"}
									>
										<i
											class="bi bi-{showIcon(nb.notebook_category_id)} text-lg"
										/>
									</span>
								</div>
							</button>
						{/each}

						<Modal size="small">
							<Content
								class="rounded border bg-primary border-secondary text-slate-900 dark:text-slate-50 py-3 w-[600px]"
								title="Add Notebook"
							>
								<NewNotebookForm {categories} />
							</Content>
							<Trigger>
								<button class="px-2 py-3">
									<div
										class="md:tooltip md:tooltip-right"
										data-tip="Add notebook"
									>
										<span class="text-black dark:text-white py-1">
											<i class="bi bi-plus-square text-lg" />
										</span>
									</div>
								</button>
							</Trigger>
						</Modal>
					</div>
				</div>
				<div class="m-2">
					<Modal>
						<Content
							class="rounded border bg-primary border-secondary w-2/12 max-w-xs h-[400px] text-slate-900 dark:text-slate-50 py-3"
							title="App Settings"
						>
							<AppSettingsForm {notebooks} />
						</Content>
						<Trigger>
							<div class="md:tooltip md:tooltip-right" data-tip="Settings">
								<button
									class="btn btn-ghost btn-circle bg-none p-1 hover:bg-transparent hover:border-transparent w-8 h-8"
								>
									<i class="bi bi-gear text-lg" />
								</button>
							</div>
						</Trigger>
					</Modal>
				</div>
			</div>
		</div>
		<div class="w-[100%] md:w-[30%] mr-auto bg-primary">
			<div class="h-screen relative flex flex-col">
				<div class="w-[100%] md:w-[30%] mr-auto flex flex-col mb-2 fixed">
					<div
						class="flex justify-between items-center h-12 pl-3 pr-2 border-b border-secondary border-opacity-50"
					>
						<div class="ml-2">
							{#if notebook}
								<div class="font-semibold text-base">
									{notebook.name}
								</div>
							{:else}
								<div class="font-semibold text-base">Add notebook</div>
							{/if}
						</div>
						<div class="flex gap-2 ml-auto justify-end">
							<div class="tooltip tooltip-bottom" data-tip="New entry">
								<button
									class="btn btn-ghost btn-circle bg-none px-1 hover:bg-transparent hover:border-transparent w-8 h-8 {notebook
										? ''
										: 'disabled'}"
								>
									<i class="bi bi-plus-lg text-lg" />
								</button>
							</div>
							<div class="">
								<div class="dropdown dropdown-end">
									<label
										tabindex="-1"
										class="btn btn-circle btn-ghost bg-none px-1 hover:bg-transparent hover:border-transparent w-12 h-8"
										for=""
									>
										<i class="bi bi-three-dots text-lg" />
									</label>
									<ul
										tabindex="-1"
										class="dropdown-content p-1 bg-neutral shadow rounded w-40 gap-1"
									>
										<li class="">
											<div class="p-0 gap-0">
												<Modal>
													<Content
														class="rounded border bg-primary border-secondary w-2/12 max-w-xs h-[400px] text-slate-900 dark:text-slate-50 py-3"
														title="Notebook Settings"
													>
														<NotebookSettingsForm />
													</Content>
													<Trigger>
														<button
															class="flex justify-start items-center gap-2 py-1 px-2 text-slate-900 dark:text-slate-50"
														>
															<i class="bi bi-sliders2 text-base" />
															<span class="text-xs font-medium"
																>Notebook Options</span
															>
														</button>
													</Trigger>
												</Modal>
											</div>
										</li>
										<hr
											class="w-full border border-secondary border-opacity-50"
										/>
										<li class="p-0">
											<div class="p-0">
												<Modal size="small">
													<Content
														class="rounded border bg-primary border-secondary text-slate-900 dark:text-slate-50 py-3"
														title="Remove Notebook"
													>
														<RemoveNotebookForm {notebook} />
													</Content>
													<Trigger>
														<button
															class="flex justify-start items-center gap-2 py-1 px-2 text-error"
														>
															<i class="bi bi-trash text-base" />
															<span class="text-xs font-medium"
																>Remove Notebook</span
															>
														</button>
													</Trigger>
												</Modal>
											</div>
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
				</div>
				<div class="w-full px-4 overflow-y-auto mt-24">
					<button class="btn-block text-left py-4 focus:outline-none">
						<div class="px-3 border-l-4">
							<div class="text-xs opacity-60">
								{newEntry.created_at}
							</div>
							<div class="font-medium">{newEntry.title}</div>
						</div>
					</button>
					{#each notebook.entries as entry}
						<button
							class="btn-block text-left py-4 focus:outline-none {view !=
							undefined
								? entry.id === view.id
									? 'text-black dark:text-white'
									: 'text-gray-700 dark:text-gray-300 hover:text-black hover:dark:text-white'
								: 'text-gray-700 dark:text-gray-300 hover:text-black hover:dark:text-white'}"
							on:click={showEntry(entry.id)}
						>
							<div
								class="px-3 border-l-4 {view != undefined
									? entry.id === view.id
										? 'border-accent'
										: 'border-transparent'
									: 'border-transparent'}"
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
							<span class="text-sm italic">{view.created_at}</span>
							<span class="mx-2">|</span>
							<span class="badge badge-accent text-white rounded font-black"
								>{view.created_at}</span
							>
						</div>
						<div class="flex">
							<div class="">
								<div class="">
									<Modal size="small">
										<Content
											class="rounded border bg-primary border-secondary text-slate-900 dark:text-slate-50 py-3"
											title="Stats"
										>
											<ul class="flex flex-col gap-2 p-3 text-sm">
												<li class="flex justify-between">
													<span class="italic">Modified</span>
													<span class="opacity-80">{view.created_at}</span>
												</li>
												<li class="flex justify-between">
													<span class="italic">Last Synced</span>
													<span class="opacity-80">{view.created_at}</span>
												</li>
												<li class="flex justify-between">
													<span class="italic">Words</span>
													<span class="opacity-80">250</span>
												</li>
												<li class="flex justify-between">
													<span class="italic">Characters</span>
													<span class="opacity-80">250</span>
												</li>
											</ul>
										</Content>
										<Trigger>
											<div
												class="md:tooltip md:tooltip-right"
												data-tip="Settings"
											>
												<button
													class="btn btn-ghost btn-circle bg-none p-1 hover:bg-transparent hover:border-transparent w-8 h-8"
												>
													<i class="bi bi-info-circle text-lg" />
												</button>
											</div>
										</Trigger>
									</Modal>
								</div>
							</div>
							<div class="dropdown dropdown-end">
								<label
									tabindex="-1"
									class="btn btn-circle btn-ghost bg-none px-1 hover:bg-transparent hover:border-transparent w-8 h-8"
									for=""
								>
									<i class="bi bi-three-dots-vertical text-lg" />
								</label>
								<ul
									tabindex="-1"
									class="dropdown-content menu p-1 bg-primary shadow rounded w-40 gap-1"
								>
									<li>
										<button
											class="justify-start items-center no-underline capitalize px-2 py-1 hover:no-underline text-slate-900 dark:text-slate-50"
										>
											<i class="bi bi-sliders2 text-lg" />
											<span class="text-xs font-medium">Options</span>
										</button>
									</li>
									<li>
										<button
											class="justify-start items-center no-underline capitalize px-2 py-1 hover:no-underline text-error"
										>
											<i class="bi bi-trash text-lg" />
											<span class="text-xs font-medium">Move to trash</span>
										</button>
									</li>
								</ul>
							</div>
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
