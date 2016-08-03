<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<script type="text/javascript" src="md5-min.js"></script>

<script type="text/javascript">
function AddTrack()
{
           var jsonObj = null;
           var track = [];
           var userId = 34;
           var apikey = "2fa4c69a8aba5f8f9a38c35873ca325f";
           track.push({trackingUserClientPhone: '79160000000', trackingUserClientTrack: '19527937484546',trackingUserClientEmail: 'support@r-lab.biz',trackingUserClientName:'����',trackingUserClientItemCost:123,trackingUserClientOrderNumer:'12345',sendToUserEmailFullTracking:false,sendToAdminEmailFullTracking:false});
           track.push({trackingUserClientPhone: '79150000000', trackingUserClientTrack: '63010828068631',trackingUserClientEmail: 'support@r-lab.biz',trackingUserClientName:'����2',trackingUserClientItemCost:1234,trackingUserClientOrderNumer:'12346',sendToUserEmailFullTracking:false,sendToAdminEmailFullTracking:false});
           var hash = hex_md5(userId+':1952793748454663010828068631:'+apikey);
           jsonObj={trackingUserId: userId, trackingRequestKey: hash,testMode: false,trackingData:track};
           //testMode - true (����� �� ����������� � ����, ������ �������� �������)

try {
$.ajax({
type: "POST",
url:"http://apilr2.r-lab.biz/addtrack.ashx",
dataType: "json",
data: JSON.stringify(jsonObj),
timeout: 15000,
async: true,
beforeSend: function(x) {
if (x && x.overrideMimeType) {x.overrideMimeType("application/json;charset=UTF-8");}},
success: function(data) {if (data) {alert(data.resultInfo);}},
error: function() {},
parsererror: function() {}
});
}
catch (e) {}
}
</script>
<input type="button" value="AddTrack" onclick="AddTrack();" />


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
