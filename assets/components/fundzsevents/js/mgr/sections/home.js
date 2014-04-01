fundzsEvents.page.Home = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		components: [{
			xtype: 'fundzsevents-panel-home'
			,renderTo: 'fundzsevents-panel-home-div'
		}]
	}); 
	fundzsEvents.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(fundzsEvents.page.Home,MODx.Component);
Ext.reg('fundzsevents-page-home',fundzsEvents.page.Home);