<?php
    namespace SVX\Admin\Controller;

    use Sebastian\Core\Controller\Controller;
    use Sebastian\Core\Http\Request;
    use Sebastian\Core\Http\Response\Response;
    use Sebastian\Utility\Utility\Utils;

    use SVX\Common\Entity\Contract;
    use SVX\Common\Entity\ContractItem;
    use SVX\Common\Entity\Partner;

    class AdminController extends Controller {
        public function manageCacheAction(Request $request) {
            $cm = $this->getCacheManager();

            $diskTotal = disk_total_space('/');
            $diskFree = disk_free_space('/');

            return $this->render('admin/cache', [
                'cache' => $cm->getInfo(),
                'mem' => $cm->getMemInfo(),
                'loadAverages' => [
                    '5' => sys_getloadavg()[0],
                    '10' => sys_getloadavg()[1],
                    '15' => sys_getloadavg()[2]
                ],
                'disk' => [
                    'total' => $diskTotal,
                    'remaining' => $diskFree,
                    'utilization' => 100 - round((($diskFree / $diskTotal) * 100), 3)
                ]
            ]);
        }

        public function invalidateCacheAction(Request $request) {
            $key = $request->get('key');
            $cm = $this->getCacheManager();

            if ($cm->isCached($key)) {
                $cm->invalidate($key);    

                return new Response(1);
            } else {
                return new Response(0);
            }
        }

        public function testAction() {
            die('admin test');
        }
    }