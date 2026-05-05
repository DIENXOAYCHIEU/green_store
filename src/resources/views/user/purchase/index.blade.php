@vite('resources/js/purchase.js')
<x-layout>

	<div class="bg-gray-100 min-h-screen py-6">

		<div class="max-w-[1200px] mx-auto flex gap-6">

			<x-account-sidebar />

			<div class="flex-1">

				<div class="flex flex-col gap-4">

					<x-card>
						<x-purchase-tabs :statuses="$statuses" :selectedStatus="$selected_status" />
					</x-card>

					@if(!$selected_status)
						<x-card>
							<x-purchase-search />
						</x-card>
					@endif

					<div>
						<div id="orders-container" class="flex flex-col gap-4"></div>

						<div id="scroll-trigger" class="h-10"></div>
					</div>


					<div id="loading" class="text-center py-6 hidden">
						<div class="animate-spin rounded-full h-8 w-8 border-b-2 border-green-500 mx-auto"></div>
					</div>

				</div>

			</div>

		</div>

	</div>
</x-layout>