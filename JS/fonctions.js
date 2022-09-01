/*--- FONCTION JS ----		*/
		
		
		function DisplayBlock(IDblock)
						{
							
								if ( $(IDblock).css("display") == 'block'){
										$(IDblock).css("display","none");
								}
								else if( $(IDblock).css("display") == 'none'){
									$(IDblock).css("display","block");
								};
						}
		
		/* ******************************************************************************
		* Ouverture des Popup
		****************************************************************************** */
		function ouvrePopup(sPage, iLarg, iHaut){
			var iTop=(screen.height-iHaut)/2;
			var iLeft=(screen.width-iLarg)/2;
			window.open(sPage, "popup", "resizable=no, location=no, menubar=no, status=no, scrollbars=no, top="+iTop+",left="+iLeft+",width="+iLarg+", height="+iHaut);
			return false;
		}
		/* ******************************************************************************
		* Fermeture des Popup
		*******************************************************************************/
		function fermePopup(){
			opener = self;
			self.close();
		}
