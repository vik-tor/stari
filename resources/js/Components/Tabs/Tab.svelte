<script>
	import { getContext } from "svelte";
	import { tabContextId } from "./Tabs.svelte";

	export let id;

	const { selectedTab, selectTab } = getContext(tabContextId);
</script>

<button
	class="tab tab-bordered text-base-100 text-xs font-medium uppercase {$selectedTab ===
	id
		? 'border-accent'
		: ''}"
	on:click={() => selectTab(id)}
	><slot />
</button>
