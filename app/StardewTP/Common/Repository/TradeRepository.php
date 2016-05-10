<?php
    namespace StardewTP\Common\Repository;

    use SebastianExtra\Repository\Repository;

    class TradeRepository extends Repository {
        public function getAllTrades($limit, $offset, $orderBy = []) {
            $conn = $this->getConnection();
            $query = "
                SELECT 
                    t.id,t.asking_price,t.status,t.title,t.created_at,t.modified_at,
                    i.name as item, i.image_url as item_image,ti.amount,ti.quality,
                    f.username as buyer, f2.username as seller
                FROM trade_items ti 
                LEFT JOIN items i ON ti.item = i.id 
                LEFT JOIN trades t ON t.id = ti.trade 
                LEFT JOIN farmers f ON t.buyer = f.unique_id_fixed
                LEFT JOIN farmers f2 ON t.seller = f2.unique_id_fixed
                WHERE ti.trade IN (
                    SELECT id FROM trades t ORDER BY t.id ASC LIMIT :limit OFFSET :offset
                );";
        
            $trades = $conn->execute($query, [
                'limit' => $limit,
                'offset' => $offset
            ])->fetchAll();

            $finalTrades = [];

            foreach ($trades as $trade) {
                $id = $trade['id'];
                if (!array_key_exists($id, $finalTrades)) {
                    $finalTrades[$id] = [
                        'id' => $id,
                        'asking_price' => $trade['asking_price'],
                        'title' => $trade['title'],
                        'buyer' => $trade['buyer'],
                        'seller' => $trade['seller'],
                        'items' => [],
                        'created_at' => $trade['created_at'],
                        'modified_at' => $trade['modified_at']
                    ];
                }

                $finalTrades[$id]['items'][] = [
                    'item' => $trade['item'],
                    'amount' => $trade['amount'],
                    'quality' => $trade['quality'],
                    'image' => $trade['item_image']
                ];

            }

            asort($finalTrades);

            //print_r($finalTrades); die();

            return $finalTrades;//var_dump($finalTrades); die();
        }
    }