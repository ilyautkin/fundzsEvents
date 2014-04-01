fundzsEvents.panel.Home = function(config) {
	config = config || {};
	Ext.apply(config,{
		border: false
		,baseCls: 'modx-formpanel'
		,items: [{
			html: '<h2>'+_('fundzsevents')+'</h2>'
			,border: false
			,cls: 'modx-page-header container'
		},{
			xtype: 'modx-tabs'
			,bodyStyle: 'padding: 10px'
			,defaults: { border: false ,autoHeight: true }
			,border: true
			,activeItem: 0
			,hideMode: 'offsets'
			,items: [{
				title: _('fundzsevents_items')
				,items: [{
					html: _('fundzsevents_intro_msg')
					,border: false
					,bodyCssClass: 'panel-desc'
					,bodyStyle: 'margin-bottom: 10px'
				},{
					xtype: 'fundzsevents-grid-items'
					,preventRender: true
				}]
			}]
		}]
	});
	fundzsEvents.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(fundzsEvents.panel.Home,MODx.Panel);
Ext.reg('fundzsevents-panel-home',fundzsEvents.panel.Home);
