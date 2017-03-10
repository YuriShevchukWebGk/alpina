<?
class BookAPI {

    private $response_array = Array(
        'status_code' => "",
        'data'        => NULL
    );
	
	/**
	 * 
	 * Получить книгу
	 * 
	 * 
	 * @param int $id
	 * @return array
	 * 
	 * */
	private function getBook($id) {
		$book_result = CIBlockElement::GetList(
			Array(),
			Array(
				"IBLOCK_ID" => CATALOG_IBLOCK_ID,
				"ID"        => $id
			),
			false,
			Array(
				"nPageSize" => 1
			),
			Array()
		);
		if ($book = $book_result->GetNextElement()) {
			return $book;
		}
	}

	/**
	 * 
	 * Получить цену книги
	 * 
	 * Ожидаемые поля: 
	 * - id
	 * 
	 * @param array $params
	 * @return array
	 * 
	 * */
	public function getBookPrice($params) {
		// формируем массив необходимых параметров
		$data = array(
			"id" => $params['id']
		);
		$data = array_filter($data);
		// валидация и выполнение необходимых действий
		if ((is_array($data) && !empty($data))) {
			// проверяем id
			if (Validator::isKeyValuePairExists($data, "id")) {
				if ($book = $this->getBook($data['id'])) {
					$prices = CPrice::GetBasePrice($data['id']);
					if ($prices["PRICE"]) {
						$this->responseArray['status_code'] = "success";
						$this->responseArray['data'] = $prices["PRICE"];
					} else {
						$this->responseArray['status_code'] = "error";
						$this->responseArray['data'] = sprintf(APITools::getLangPhrase("price_does_not_exist"));
					}
				} else {
					$this->responseArray['status_code'] = "error";
					$this->responseArray['data'] = sprintf(APITools::getLangPhrase("book_does_not_exist"));
				}
			} else {
				$this->responseArray['status_code'] = "error";
				$this->responseArray['data'] = sprintf(APITools::getLangPhrase("parameter_missed"), "id");
			}
		} else {
			$this->responseArray['status_code'] = "error";
			$this->responseArray['data'] = APITools::getLangPhrase("data_invalid");
		}
		return $this->responseArray;
	}
}
?>