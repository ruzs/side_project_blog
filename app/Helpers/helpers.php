<?php
// 取得毫秒
function getMilliseconds($len = -3)
{
    return substr(gettimeofday()["usec"], $len);
}

// 產生 亂數三碼
function gen_garbled()
{
    return sprintf(
        '%x%x%x',
        mt_rand(0, 0xe),
        mt_rand(0, 0xe),
        mt_rand(0, 0xe)
    );
}

// 產生UUIDv4
function gen_uuid()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}
function getUnitName()
{
    $route = request()->route()->getName();
    $routes = explode('.', $route);
    return $routes[0];
}

// get route name from request
function getRouteNameMode()
{
    $route = request()->route()->getName();
    $routes = explode('.', $route);
    return $routes[count($routes) - 1];
}

// 判斷當前 route 是否為 show
function isShowMode()
{
    return getRouteNameMode() === 'show';
}

// 判斷當前單元是否有 show 的路由存在
function checkRouteShowIsExist()
{
    $route = request()->route()->getName();
    $routes = explode('.', $route);

    array_pop($routes);
    $route_node = implode('.', $routes);
    
    return \Route::has($route_node.'.show');
}


/** permission */
function isAdminAccount()
{
    return @auth()->user()->isAdminAccount();
}

// 檢查用戶有權限 而且 網域也允許
function isAdminRoleAccount()
{
    return @auth()->user()->isAdminRole();
}

// 檢查用戶有權限 而且 網域也允許
function isAuth($permission_name)
{
    return auth()->user()->can($permission_name);
}

function isAuthor($created_by)
{
    return $created_by === auth()->user()->id || isAdminRoleAccount();
}

function isAuthAndCreator($permission_name, $created_by)
{
    return isAuth($permission_name) && isAuthor($created_by);
}

function isOwner($created_by, $assignee)
{
    return $created_by === auth()->user()->id || $assignee === auth()->user()->id || isAdminRoleAccount();
}

function isAuthAndOwn($permission_name, $created_by, $assignee)
{
    return isAuth($permission_name) && isOwner($created_by, $assignee);
}

// 如果用戶沒權限，則跳轉至403
function redirectIfNotAuth($permission_name, $author_check = true)
{
    // $author_check: 需判斷是否為作者
    if (!isAuth($permission_name) || !($author_check || isAdminRoleAccount())) {
        abort("403", "This action is unauthorized.");
    }
}

// 如果用戶沒權限，則回復response json
function responseIfNotAuth($permission_name)
{
    if (!isAuth($permission_name)) {
        return response()->json([
            'success' => false,
        ], 403, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }
}

// 如果用戶沒權限，則回復 json
function returnFalseIfNotAuth($permission_name)
{
    if (!isAuth($permission_name)) {
        // throw new \Exception(config('errors.unauthorized.message'), config('errors.unauthorized.code'));
        return [
            'success' => false,
            'message' => config('errors.unauthorized.message'),
        ];
    }
}
/** /.permission */

function getLastWeekDateRrange()
{
    $last_monday = date("Y-m-d", strtotime("last week monday"));
    $last_sunday = date("Y-m-d", strtotime("last week sunday"));
    return [$last_monday, $last_sunday];
}


function getLastWeekDateTimeRrange()
{
    $last_monday = date("Y-m-d", strtotime("last week monday")).' 00:00:00';
    $last_sunday = date("Y-m-d", strtotime("last week sunday")).' 23:59:59';
    return [$last_monday, $last_sunday];
}

function getTaskStatusList()
{
    $task_status = [];
    foreach (config('constants.task_status') as $key => $status) {
        array_push($task_status, $status);
    }
    return $task_status;
}

function getIssueStatusList()
{
    $issue_status = [];
    foreach (config('constants.issue_status') as $key => $status) {
        array_push($issue_status, $status);
    }
    return $issue_status;
}

function getTaskStatusLabel($status)
{
    foreach (config('constants.task_status') as $task_status) {
        if ($status == $task_status['value']) {
            return $task_status['label'];
        }
    }
    return '';
}

function getIssueStatusLabel($status)
{
    foreach (config('constants.issue_status') as $issue_status) {
        if ($status == $issue_status['value']) {
            return $issue_status['label'];
        }
    }
    return '';
}
function getAssigneeName($assignee)
{
    $users=$user_repo->getAllUser();
    foreach ($users as $user) {
        if ($assignee == $user['id']) {
            return $user['name'];
        }
    }
    return '';
}

function getPriorityLabel($priority)
{
    foreach (config('constants.priority_types') as $priority_type) {
        if ($priority == $priority_type['value']) {
            return $priority_type['label'];
        }
    }
    return '';
}

function getDayOffTypeLabel($dayoff_type)
{
    foreach (config('constants.dayoff_types') as $type) {
        if ($dayoff_type == $type['value']) {
            return $type['label'];
        }
    }
    return '';
}

// sidebar notebook list
function sidebarNotebookList($notebook_lists, $note_path = null)
{
    // ex: 1/2/3
    $request_note_path = @$note_path ? explode('.', $note_path) : [];

    $navItem = '';
    foreach ($notebook_lists as $notebook) {
        $isRoot = $notebook->parent ? '' : 'is-root';
        $path = $notebook->uuid;
        $children = $notebook->children->where('type', config('constants.note_types.notebook.value'));
        if ($children->count()) {
            $childHtml = sidebarNotebookList($children, @$note_path);

            $menuOpen = in_array($notebook->id, $request_note_path) ? 'menu-open' : '';
            $navItem .= '
                <li class="nav-item has-treeview '.$menuOpen.'">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-solid fa-book"></i>
                        <p>'.$notebook->title.' <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">'.$childHtml.'</ul>
                </li>';
        }
        else {
            $link = \Route::currentRouteName() === 'note.index' ? 'javascript:void(0)' : route('note.index', ['uuid' => $path]);
            // $link = route('note.index', ['uuid' => $path]);
            // $active = $notebook->uuid == $note_path ? 'active' : '';
            $active = in_array($notebook->id, $request_note_path) ? 'active' : '';
            $navItem .= '
                <li class="nav-item">
                    <a href="'.$link.'" class="nav-link btn-notebook '.$active.'" data-uuid="'.$path.'">
                        <i class="nav-icon fa fa-solid fa-book"></i>
                        <p>'.$notebook->title.'</p>
                    </a>
                </li>';
        }
    }

    return $navItem;
}