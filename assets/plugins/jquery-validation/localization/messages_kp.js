/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: KP (D.P.R.Korean; 조선어)
 */
(function ($) {
	$.extend($.validator.messages, {
		required: "필수항목입니다.",
		remote: "항목을 수정하십시오.",
		email: "유효하지 않은 E-Mail주소입니다.",
		url: "유효하지 않은 주소입니다.",
		date: "정확하게 날자를 입력하십시오.",
		dateISO: "정확하게 날자(ISO)를 입력하십시오.",
		number: "유효한 수자가 아닙니다.",
		digits: "수자만 입력 가능합니다.",
		creditcard: "신용카드번호가 정확하지 않습니다.",
		equalTo: "같은값을 다시 입력하십시오.",
		accept: "정확한 확장자가 아닙니다.",
		maxlength: $.format("{0}문자를 넘을 수 없습니다. "),
		minlength: $.format("{0}문자 이상으로 입력하십시오."),
		rangelength: $.format("문자 길이를 {0} 에서 {1} 사이로 입력하십시오."),
		range: $.format("{0} 에서 {1} 값을 입력하십시오."),
		max: $.format("{0} 이하의 값을 입력하십시오."),
		min: $.format("{0} 이상의 값을 입력하십시오.")
	});
}(jQuery));
