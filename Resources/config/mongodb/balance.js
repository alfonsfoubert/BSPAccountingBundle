function (account)
{
	var total = 0;
	db.transactions.find( { "accounting_entries.account" : account } ).forEach(
		function(obj)
		{
			for (var i = 0; i < obj.accounting_entries.length; i++)
			{
				if (obj.accounting_entries[i].account == account)
				{
					total += obj.accounting_entries[i].amount;
				}
			}
		}
	);
	return total;
}