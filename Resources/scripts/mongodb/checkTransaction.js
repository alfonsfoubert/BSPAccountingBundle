function (entries)
{
	if (entries.length == 0) return false;

	var total = 0;
	for (var i = 0; i < entries.length; i++)
	{
		total += entries[i].amount;
	}

	return (total == 0);
}