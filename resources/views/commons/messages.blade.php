
<!DOCTYPE html>
<html lang="ja">
<head>
</head>
<body>
</body>
</html>

<script type="text/javascript">
	// 完了後ポップアップ表示
	const is_after_complete = "{{ Session::get('message') }}";
	if (is_after_complete) {
		// sessionStorageはブラウザバックで完了ポップアップが出てしまうのを防ぐために利用している
		if (sessionStorage.getItem('message') != "1") {
			alert(is_after_complete);
			sessionStorage.setItem('message', "1");
		}
	}

	// ブラウザバックで完了ポップアップが出てしまうのを防ぐための処理
	$('form').submit(function() {
		sessionStorage.setItem('message', "0");
	})
</script>