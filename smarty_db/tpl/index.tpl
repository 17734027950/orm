<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>数据字典</title>
</head>
<body>
	<table>
		{section name=tb loop=$item}
            <tr>
				<td>{$item.table_name}</td>
				<td>{$item.table_comment}</td>
			</tr>
        {section}
	</table>
</body>
</html>