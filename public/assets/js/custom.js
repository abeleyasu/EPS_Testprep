function expendList(e, listorder){
	
	var clickCls = 'rotateIcon'+listorder;
	if(jQuery('.'+clickCls).hasClass('fa-angle-up')){
		jQuery('.'+clickCls).removeClass('fa-angle-up');
		jQuery('.'+clickCls).addClass('fa-angle-down');
	}else{
		jQuery('.'+clickCls).removeClass('fa-angle-down');
		jQuery('.'+clickCls).addClass('fa-angle-up');
		
	}
	var activeCls = 'childdiv'+listorder;
	if(jQuery('.'+activeCls).hasClass('composlist')){
		jQuery('.'+activeCls).removeClass('composlist');
		jQuery('.'+activeCls).show(600);
	}else{
		jQuery('.'+activeCls).hide(600);
		jQuery('.'+activeCls).addClass('composlist');
	}
}