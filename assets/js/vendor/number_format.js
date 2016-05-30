// http://www.mredkj.com/javascript/numberFormat.html

var numberFormat = (function(window, undefined){


  	// Module settigns
	var settings = {
		version : 'Number Format v1.5.4',
	    comma : ',',
	    period : '.',
	    dash : '-',
	    left_paren : '(',
		right_paren : ')',
	    left_outside : 0,
	    left_inside : 1,
	    right_inside : 2,
	    right_outside : 3,
	    left_dash : 0,
	    right_dash : 1,
	    parenthesis : 2,
	    no_rounding : -1,
	    num : null,
	    numOriginal : null,
	    hasSeparators : false,
	    separatorValue : null,
	    inputDecimalValue : null,
	    decimalValue : null,
	    negativeFormat : null,
	    negativeRed : null,
	    hasCurrency : false, 
	    currencyPosition : null,
	    currencyValue : null,
	    places : null,
	    roundToPlaces : null,
	    truncate : null
	};

	var setInputDecimal = function(val) {
	    settings.inputDecimalValue = val;
	};

	var setNumber = function(num, inputDecimal) {
	    if (inputDecimal != null) {
	    	setInputDecimal(inputDecimal);
	    }
	    settings.numOriginal = num;
	    settings.num = justNumber(num);
	};

	var toUnformatted = function() {
	    return (settings.num);
	};

	var getOriginal = function() {
	    return (settings.numOriginal);
	};

	var setNegativeFormat = function(format) {
	    settings.negativeFormat = format;
	};

	var setNegativeRed = function(isRed) {
	    settings.negativeRed = isRed;
	};

	var setSeparators = function(isC, separator, decimal) {
	    settings.hasSeparators = isC;
	    if (separator == null) separator = settings.comma;
	    if (decimal == null) decimal = settings.period;
	    if (separator == decimal) {
	        settings.decimalValue = (decimal == settings.period) ? settings.comma : settings.period;
	    } else {
	        settings.decimalValue = decimal;
	    }
	    settings.separatorValue = separator;
	};

	var setCommas = function(isC) {
	    setSeparators(isC, settings.comma, settings.period);
	};

	var setCurrency = function(isC) {
	    settings.hasCurrency = isC;
	};

	var setCurrencyValue = function(val) {
	    settings.currencyValue = val;
	};

	var setCurrencyPrefix = function(cp) {
	    setCurrencyValue(cp);
	    setCurrencyPosition(settings.left_outside);
	};

	var setCurrencyPosition = function(cp) {
	    settings.currencyPosition = cp
	};

	var setPlaces = function(p, tr) {
	    settings.roundToPlaces = !(p == settings.no_rounding);
	    settings.truncate = (tr != null && tr);
	    settings.places = (p < 0) ? 0 : p;
	};

	var addSeparators = function(nStr, inD, outD, sep) {
	    nStr += '';
	    var dpos = nStr.indexOf(inD);
	    var nStrEnd = '';
	    if (dpos != -1) {
	        nStrEnd = outD + nStr.substring(dpos + 1, nStr.length);
	        nStr = nStr.substring(0, dpos);
	    }
	    var rgx = /(\d+)(\d{3})/;
	    while (rgx.test(nStr)) {
	        nStr = nStr.replace(rgx, '$1' + sep + '$2');
	    }
	    return nStr + nStrEnd;
	};

	var toFormatted = function() {
	    var pos;
	    var nNum = settings.num;
	    var nStr;
	    var splitString = new Array(2);
	    if (settings.roundToPlaces) {
	        nNum = getRounded(nNum);
	        nStr = preserveZeros(Math.abs(nNum));
	    } else {
	        nStr = expandExponential(Math.abs(nNum));
	    }
	    if (settings.hasSeparators) {
	        nStr = addSeparators(nStr, settings.period, settings.decimalValue, settings.separatorValue);
	    } else {
	        nStr = nStr.replace(new RegExp('\\' + settings.period), settings.decimalValue);
	    }
	    var c0 = '';
	    var n0 = '';
	    var c1 = '';
	    var n1 = '';
	    var n2 = '';
	    var c2 = '';
	    var n3 = '';
	    var c3 = '';
	    var negSignL = (settings.negativeFormat == settings.parenthesis) ? settings.left_paren : settings.dash;
	    var negSignR = (settings.negativeFormat == settings.parenthesis) ? settings.right_paren : settings.dash;
	    if (settings.currencyPosition == settings.left_outside) {
	        if (nNum < 0) {
	            if (settings.negativeFormat == settings.left_dash || settings.negativeFormat == settings.parenthesis) n1 = negSignL;
	            if (settings.negativeFormat == settings.right_dash || settings.negativeFormat == settings.parenthesis) n2 = negSignR;
	        }
	        if (settings.hasCurrency) c0 = settings.currencyValue;
	    } else if (settings.currencyPosition == settings.left_inside) {
	        if (nNum < 0) {
	            if (settings.negativeFormat == settings.left_dash || settings.negativeFormat == settings.parenthesis) n0 = negSignL;
	            if (settings.negativeFormat == settings.right_dash || settings.negativeFormat == settings.parenthesis) n3 = negSignR;
	        }
	        if (settings.hasCurrency) c1 = settings.currencyValue;
	    } else if (settings.currencyPosition == settings.right_inside) {
	        if (nNum < 0) {
	            if (settings.negativeFormat == settings.left_dash || settings.negativeFormat == settings.parenthesis) n0 = negSignL;
	            if (settings.negativeFormat == settings.right_dash || settings.negativeFormat == settings.parenthesis) n3 = negSignR;
	        }
	        if (settings.hasCurrency) c2 = settings.currencyValue;
	    } else if (settings.currencyPosition == settings.right_outside) {
	        if (nNum < 0) {
	            if (settings.negativeFormat == settings.left_dash || settings.negativeFormat == settings.parenthesis) n1 = negSignL;
	            if (settings.negativeFormat == settings.right_dash || settings.negativeFormat == settings.parenthesis) n2 = negSignR;
	        }
	        if (settings.hasCurrency) c3 = settings.currencyValue;
	    }
	    nStr = c0 + n0 + c1 + n1 + nStr + n2 + c2 + n3 + c3;
	    if (settings.negativeRed && nNum < 0) {
	        nStr = '<font color="red">' + nStr + '</font>';
	    }
	    return (nStr);
	};

	var toPercentage = function() {
	    nNum = settings.num * 100;
	    nNum = getRounded(nNum);
	    return nNum + '%';
	};

	var getZeros = function(places) {
	    var extraZ = '';
	    var i;
	    for (i = 0; i < places; i++) {
	        extraZ += '0';
	    }
	    return extraZ;
	};

	var expandExponential = function(origVal) {
	    if (isNaN(origVal)) return origVal;
	    var newVal = parseFloat(origVal) + '';
	    var eLoc = newVal.toLowerCase().indexOf('e');
	    if (eLoc != -1) {
	        var plusLoc = newVal.toLowerCase().indexOf('+');
	        var negLoc = newVal.toLowerCase().indexOf('-', eLoc);
	        var justNumber = newVal.substring(0, eLoc);
	        if (negLoc != -1) {
	            var places = newVal.substring(negLoc + 1, newVal.length);
	            justNumber = moveDecimalAsString(justNumber, true, parseInt(places));
	        } else {
	            if (plusLoc == -1) plusLoc = eLoc;
	            var places = newVal.substring(plusLoc + 1, newVal.length);
	            justNumber = moveDecimalAsString(justNumber, false, parseInt(places));
	        }
	        newVal = justNumber;
	    }
	    return newVal;
	};

	var moveDecimalRight = function(val, places) {
	    var newVal = '';
	    if (places == null) {
	        newVal = moveDecimal(val, false);
	    } else {
	        newVal = moveDecimal(val, false, places);
	    }
	    return newVal;
	};

	var moveDecimalLeft = function(val, places) {
	    var newVal = '';
	    if (places == null) {
	        newVal = moveDecimal(val, true);
	    } else {
	        newVal = moveDecimal(val, true, places);
	    }
	    return newVal;
	};

	var moveDecimalAsString = function(val, left, places) {
	    var spaces = (arguments.length < 3) ? settings.places : places;
	    if (spaces <= 0) return val;
	    var newVal = val + '';
	    var extraZ = getZeros(spaces);
	    var re1 = new RegExp('([0-9.]+)');
	    if (left) {
	        newVal = newVal.replace(re1, extraZ + '$1');
	        var re2 = new RegExp('(-?)([0-9]*)([0-9]{' + spaces + '})(\\.?)');
	        newVal = newVal.replace(re2, '$1$2.$3');
	    } else {
	        var reArray = re1.exec(newVal);
	        if (reArray != null) {
	            newVal = newVal.substring(0, reArray.index) + reArray[1] + extraZ + newVal.substring(reArray.index + reArray[0].length);
	        }
	        var re2 = new RegExp('(-?)([0-9]*)(\\.?)([0-9]{' + spaces + '})');
	        newVal = newVal.replace(re2, '$1$2$4.');
	    }
	    newVal = newVal.replace(/\.$/, '');
	    return newVal;
	};

	var moveDecimal = function(val, left, places) {
	    var newVal = '';
	    if (places == null) {
	        newVal = moveDecimalAsString(val, left);
	    } else {
	        newVal = moveDecimalAsString(val, left, places);
	    }
	    return parseFloat(newVal);
	};

	var getRounded = function(val) {
	    val = moveDecimalRight(val);
	    if (settings.truncate) {
	        val = val >= 0 ? Math.floor(val) : Math.ceil(val);
	    } else {
	        val = Math.round(val);
	    }
	    val = moveDecimalLeft(val);
	    return val;
	};

	var preserveZeros = function(val) {
	    var i;
	    val = expandExponential(val);
	    if (settings.places <= 0) return val;
	    var decimalPos = val.indexOf('.');
	    if (decimalPos == -1) {
	        val += '.';
	        for (i = 0; i < settings.places; i++) {
	            val += '0';
	        }
	    } else {
	        var actualDecimals = (val.length - 1) - decimalPos;
	        var difference = settings.places - actualDecimals;
	        for (i = 0; i < difference; i++) {
	            val += '0';
	        }
	    }
	    return val;
	};

	var justNumber = function(val) {
	    newVal = val + '';
	    var isPercentage = false;
	    if (newVal.indexOf('%') != -1) {
	        newVal = newVal.replace(/\%/g, '');
	        isPercentage = true;
	    }
	    var re = new RegExp('[^\\' + settings.inputDecimalValue + '\\d\\-\\+\\(\\)eE]', 'g');
	    newVal = newVal.replace(re, '');
	    var tempRe = new RegExp('[' + settings.inputDecimalValue + ']', 'g');
	    var treArray = tempRe.exec(newVal);
	    if (treArray != null) {
	        var tempRight = newVal.substring(treArray.index + treArray[0].length);
	        newVal = newVal.substring(0, treArray.index) + settings.period + tempRight.replace(tempRe, '');
	    }
	    if (newVal.charAt(newVal.length - 1) == settings.dash) {
	        newVal = newVal.substring(0, newVal.length - 1);
	        newVal = '-' + newVal;
	    } else if (newVal.charAt(0) == settings.left_paren && newVal.charAt(newVal.length - 1) == settings.right_paren) {
	        newVal = newVal.substring(1, newVal.length - 1);
	        newVal = '-' + newVal;
	    }
	    newVal = parseFloat(newVal);
	    if (!isFinite(newVal)) {
	        newVal = 0;
	    }
	    if (isPercentage) {
	        newVal = moveDecimalLeft(newVal, 2);
	    }
	    return newVal;
	};

	return {

		money : function(num, inputDecimal){
			setCommas(true);
		    setNegativeFormat(settings.left_dash);
		    setNegativeRed(false);
		    setCurrency(false);
		    setCurrencyPrefix('$');
		    setPlaces(2);
			if (inputDecimal == null) {
				setNumber(num, settings.period);
			} else {
				setNumber(num, inputDecimal);
			}
		    return toFormatted();
		}

	}

})(window);