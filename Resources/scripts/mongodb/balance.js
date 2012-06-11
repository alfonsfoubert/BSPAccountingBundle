function (account)
{
	var total = 0;
	db.transactions.find( { "accountingEntries.account.$id" : account } ).forEach(
		function(obj)
		{
			for (var i = 0; i < obj.accountingEntries.length; i++)
			{
				if (obj.accountingEntries[i].account.$id == account)
				{
					total += obj.accountingEntries[i].amount;
				}
			}
		}
	);
	return total;
}