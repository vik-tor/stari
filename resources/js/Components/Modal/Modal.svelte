<script>
	import { id } from "./store";
	import { setContext } from "svelte";
	export let fullscreen = false;
	export let size = "normal";
	export let button = true;
	export let close = false;

	setContext("modalId", Symbol());
	setContext("fullscreen", fullscreen);
	setContext("size", size);
	setContext("button", button);
	setContext("rest", $$restProps);

	$: {
		if (close) $id = false;
	}
</script>

<slot />
