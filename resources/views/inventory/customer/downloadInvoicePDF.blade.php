<style>
	table {
		border: 1px solid #999;
		border-collapse: collapse;
		width: 100%
	}

	td {
		border: 1px solid #999
	}

	.table td,
	.table th {
		padding: 5px !important;
	}

</style>

@include('inventory.customer.invoice_content', ['customer' => $items['customer'], 'allcontainer' => $items['allcontainer'], 'allmark' => $items['allmark'], 'allproduct' => $items['allproduct']])