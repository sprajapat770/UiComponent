define(['uiElement','underscore'],function(Component,_){
	'use strict';
	return Component.extend({
		getItems: function(){
			return _.toArray(this.items);
		}
	});
});