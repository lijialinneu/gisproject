	function ShowExpert(obj){
		$(".expert").toggle();
	}

	function ShowClause(){
		$(".clause").toggle();
	}

	function ShowByMail(obj){
		$(".ByMail").toggle();
		$(".ByName").toggle();
		$(".che_2").toggle();
		$(".che_1").toggle();
		$(".che_1").attr("checked",false);
	}
	function ShowByName(obj){
		$(".ByName").toggle();
		$(".ByMail").toggle();
		$(".che_2").toggle();
		$(".che_1").toggle();
		$(".che_2").attr("checked",false);
	}