<?php
namespace Omnipay\Momoc\Message;

class UserProvisioningResponse extends AbstractResponse{

    /**
     * get the message part of the request result data
     * @return string
     */
    public function getMessage() {
        $data = $this->data;
        if(is_array($data)){
            return array_key_exists('message', $data) ? $data['message'] : 'No data';
        }
        return '';
    }

    /**
     * Get the request status description as an array of code and description
     * @return array|mixed
     */
    public function getRequestStatusDescription(){
        $code = intval($this->getCode());
        if($code == 400){
            return [
                'code' => $code,
                'message' => 'Bad request. Invalid data was sent'
            ];
        }else if($code == 409){
            return [
                'code' => $code,
                'message' => array_key_exists('message', $this->data) ? $this->data['message'] : 'Error in request. Result not processed properly.'
            ];
        }else if($code == 500){
            return [
                'code' => $code,
                'message' => 'Internal server Error in request. Result not processed properly.'
            ];
        }else{
            return $this->data;
        }
    }

}