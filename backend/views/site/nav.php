<?php
use rbac\components\MenuHelper;
use backend\widgets\Menu;
?>
<?php
		$callback = function($menu){
            $data = json_decode($menu['data'], true); 
            $items = $menu['children']; 
            $return = [ 
                'label' => $menu['name'], 
                'url' => [$menu['route']], 
            ]; 
            if ($data) { 
                isset($data['visible']) && $return['visible'] = $data['visible']; 
                isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon']; 
                $return['options'] = $data; 
            } 
            (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'fa fa-circle-o'; 
            $items && $return['items'] = $items;
            return $return; 
        }; 
        $menu = Menu::widget([
            'options' => ['class' => 'layui-nav layui-nav-tree'],
            'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback),
        ]); 
?>
		<div class="layui-side layui-bg-black top-50">
			<div class="navBar layui-side-scroll"><?=$menu?></div>
		</div>
