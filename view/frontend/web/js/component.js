define(['uiComponent','ko'],function(Component,ko){
	'use strict';
	return Component.extend({
        _currentTime: ko.observable("Loading...."),//set Initial Value
        initialize:function () {
            this._super();
            setInterval(this.updateTime.bind(this),1000);//update time every second
        },
        getTime:function (){
            return this._currentTime;
        },
        updateTime:function (){
            this._currentTime(new Date());
        }
    });
});
