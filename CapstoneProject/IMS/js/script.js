var sideBarIsOpen = true;
togglebutton.addEventListener('click',(event) => {
	event.preventDefault();
	if(sideBarIsOpen){
		Dashboard_Sidebar.style.width ='10%';
		Dashboard_Sidebar.style.transition = '0.4s all';
		Dashboard_Content_Container.style.width ='90%';
		Dashboard_Sidebar_Header.style.fontSize = '26px';
		Dashboard_Sidebar_Welcome.style.fontSize = '24px';
		User_Image.style.width = '65px';

		menuIcons = document.getElementsByClassName('menuText');
		for(var i =0; i<menuIcons.length; i++){
			menuIcons[i].style.display = 'none';
		}
		document.getElementsByClassName('Dashboard_Sidebar_Lists')[0].style.textAlign='center';
		sideBarIsOpen=false;
	}else{
		Dashboard_Sidebar.style.width ='20%';
		Dashboard_Content_Container.style.width ='80%';
		Dashboard_Sidebar_Header.style.fontSize = '30px';
		Dashboard_Sidebar_Welcome.style.fontSize = '28px';
		User_Image.style.width = '90px';

		menuIcons = document.getElementsByClassName('menuText');
		for(var i =0; i<menuIcons.length; i++){
			menuIcons[i].style.display = 'inline-block';
		}
		document.getElementsByClassName('Dashboard_Sidebar_Lists')[0].style.textAlign='left';
		sideBarIsOpen=true;
	}
});