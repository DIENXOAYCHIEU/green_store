<x-layout>
	<!-- filter -->
	<x-product-filter-bar
		:categories="$categories"
		:sort-options="$sort_options"
		:selected-categories="$selected_categories"
		:selected-categoryIds="$selected_category_ids"
		:highest-price="$highest_price"
		:lowest-price="$lowest_price"
		:selected-price="$selected_price"
		:selected-sort-option-id="$selected_sort_option_id"
	/>
	<!-- grid card -->
	<h2 class="text-2xl font-bold mb-6">Featured Products</h2>
	<div class="flex justify-center">		
		<div class="grid grid-cols-4 gap-[3rem]">
			@foreach ($products as $product)
				<x-product-card
					:product="$product"
				/>
			@endforeach
		</div>
	</div>
	<!-- links -->
	<x-product-links
		:products="$products"
		:start="$start"
		:end="$end"
	/>
</x-layout>