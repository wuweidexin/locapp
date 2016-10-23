$(document).ready(function() {
	var colM = [ {
		title : "编号",
		width : 100,
		editable : false,
		dataIndx : "id"
	},  {
		title : "精度",
		width : 100,
		editable : false,
		dataIndx : "precis"
	}, {
		title : "纬度",
		width : 130,
		editable : false,
		dataIndx : "latitude"
	}, {
		title : "创建时间",
		width : 190,
		editable : false,
		dataIndx : "createtime"
	}, {
		title : "是否已读",
		width : 100,
		editable : false,
		dataIndx : "status",
		align : "right"
	}, ];
	var dataModel = {
		location : "remote",
		dataType : "JSON",
		method : "GET",
		url : "/locapp/controller/user.php?action=showuser",
		getData : function(dataJSON) {
			return {
				curPage : dataJSON.curPage,
				totalRecords : dataJSON.totalRecords,
				data : dataJSON.data
			};
		}
	}

	var grid1 = $("div#grid_paging").pqGrid( {
		width : 900,
		height : 400,
		dataModel : dataModel,
		colModel : colM,
		//freezeCols: 2,
		pageModel : {
			type : "remote",
			rPP : 10,
			strRpp : "{0}"
		},
		sortable : false,
		wrap : false,
		hwrap : false,
		numberCell : {
			show: false
		},
	/*	numberCell : {
			resizable : true,
			width : 30,
			title : "#"
		},*///设置是否显示序列号列
		title : "人员信息",
		resizable : true
	});
	$("#testAdd").click(function() {
		var precis = $("#precis").val();
		var latitude = $("#latitude").val();
		var stacheck = $('#status').is(':checked');
		if(!precis || precis == '') {
			alert('精度不能为空');
			return;
		}
		if(!latitude || latitude == '') {
			alert('纬度不能为空');
			return;
		}
		var status = 0;
		if(stacheck) {
			status = 1;
		}
		var data = {
			'action':'adduser',
			'latitude':latitude,
			'precis':precis,
			'status':status
		};
		$.post("/locapp/controller/user.php", data, function(result) {
			$("#testshow").html(result);
			$("div#grid_paging").pqGrid("refreshDataAndView");
		});
	});
	$("#testDelete").click(function() {
		var val = $("#delId").val();
		$.post("/locapp/controller/user.php",{'action':'deleteuser', 'id':val},function(result){
		    $("#testshow").html(result);
		    $("div#grid_paging").pqGrid("refreshDataAndView");
		 });
	});
});