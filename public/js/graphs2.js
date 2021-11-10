/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/graphs2.js":
/*!*********************************!*\
  !*** ./resources/js/graphs2.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// dbColumnsToCreateSelectsFor: [main_activities,sub_activities,main_sub_options]/ [scaled_activities]
// nameIdsForSelect: [maindID,subId,optionId]/[scaled_id]
// divIdToAddRowTo: mainSubRowDiv
// const addSelectRow = (dbColumnToCreateSelectsFor,nameIdsForSelect,divIdToAddRowTo) =>{
//     -create newRowInputDiv
//     -create for each db colum in dbColumnsToCreateSelectsFor an select and add options(id and name) + create an delete button/ event.target.parentNode.remove()
//     -add all created select to newRowInputDiv
//     -add newRowInputDiv to  divIdToAddRowTo
var addSelectRow = function addSelectRow(dbColumnsToCreateSelectFor, nameIdsForSelect, divIdToAddRowTo) {
  var newRowDiv = document.createElement("div");
  dbColumnsToCreateSelectFor.forEach(function (dbColumnName, index) {
    var newSelect = document.createElement("select");
    newSelect.setAttribute("name", nameIdsForSelect[index]);
    timerData[dbColumnName].forEach(function (selectOption) {
      var newOption = document.createElement("option");
      newOption.value = selectOption["id"];
      newOption.text = selectOption["name"];
      newSelect.appendChild(newOption);
    });
    newRowDiv.appendChild(newSelect);
  });
  var deleteButton = document.createElement("button");
  deleteButton.textContent = "delete row";
  deleteButton.addEventListener("click", function (event) {
    event.target.parentNode.remove();
  });
  newRowDiv.appendChild(deleteButton);
  document.getElementById(divIdToAddRowTo).appendChild(newRowDiv);
};

var createNewMainSubInputRow = function createNewMainSubInputRow() {
  var mainSubRowOptions = [{
    "id": 0,
    "name": "total time"
  }, {
    "id": 1,
    "name": "average log time"
  }];
  timerData["sub_activities"].push({
    "id": 9999,
    "name": "All"
  });
  timerData["main_sub_options"] = mainSubRowOptions;
  document.getElementById("addMainSubInput").addEventListener("click", function (event) {
    addSelectRow(["main_activities", "sub_activities", "main_sub_options"], ["mainId", "subId", "optionId"], "mainSubInputs");
  });
};

createNewMainSubInputRow();

var createNewScaledInputRow = function createNewScaledInputRow() {
  document.getElementById("addScaledInput").addEventListener("click", function (event) {
    addSelectRow(["scaled_activities"], ["scaledId"], "scaledInputs");
  });
};

createNewScaledInputRow();

var createNewFixedInputRow = function createNewFixedInputRow() {
  document.getElementById("addFixedInput").addEventListener("click", function (event) {
    addSelectRow(["fixed_activities"], ["fixedId"], "fixedInputs");
  });
};

createNewFixedInputRow(); // scaledInputs
// addScaledInput

/***/ }),

/***/ 3:
/*!***************************************!*\
  !*** multi ./resources/js/graphs2.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\matthijn\Desktop\actlogger2\actloggerv2\resources\js\graphs2.js */"./resources/js/graphs2.js");


/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2pzL2dyYXBoczIuanMiXSwibmFtZXMiOlsiYWRkU2VsZWN0Um93IiwiZGJDb2x1bW5zVG9DcmVhdGVTZWxlY3RGb3IiLCJuYW1lSWRzRm9yU2VsZWN0IiwiZGl2SWRUb0FkZFJvd1RvIiwibmV3Um93RGl2IiwiZG9jdW1lbnQiLCJjcmVhdGVFbGVtZW50IiwiZm9yRWFjaCIsImRiQ29sdW1uTmFtZSIsImluZGV4IiwibmV3U2VsZWN0Iiwic2V0QXR0cmlidXRlIiwidGltZXJEYXRhIiwic2VsZWN0T3B0aW9uIiwibmV3T3B0aW9uIiwidmFsdWUiLCJ0ZXh0IiwiYXBwZW5kQ2hpbGQiLCJkZWxldGVCdXR0b24iLCJ0ZXh0Q29udGVudCIsImFkZEV2ZW50TGlzdGVuZXIiLCJldmVudCIsInRhcmdldCIsInBhcmVudE5vZGUiLCJyZW1vdmUiLCJnZXRFbGVtZW50QnlJZCIsImNyZWF0ZU5ld01haW5TdWJJbnB1dFJvdyIsIm1haW5TdWJSb3dPcHRpb25zIiwicHVzaCIsImNyZWF0ZU5ld1NjYWxlZElucHV0Um93IiwiY3JlYXRlTmV3Rml4ZWRJbnB1dFJvdyJdLCJtYXBwaW5ncyI6IjtRQUFBO1FBQ0E7O1FBRUE7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBOzs7UUFHQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBO1FBQ0EsMENBQTBDLGdDQUFnQztRQUMxRTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBLHdEQUF3RCxrQkFBa0I7UUFDMUU7UUFDQSxpREFBaUQsY0FBYztRQUMvRDs7UUFFQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0EseUNBQXlDLGlDQUFpQztRQUMxRSxn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QUFDekVyQixnQkFBWSxDQUFDLENBQUMsbUJBQUQsQ0FBRCxFQUF3QixDQUFDLFVBQUQsQ0FBeEIsRUFBc0MsY0FBdEMsQ0FBWjtBQUVILEdBSEQ7QUFJSCxDQVBEOztBQVNBNkIsdUJBQXVCOztBQUd2QixJQUFNQyxzQkFBc0IsR0FBRyxTQUF6QkEsc0JBQXlCLEdBQU07QUFHakN6QixVQUFRLENBQUNvQixjQUFULENBQXdCLGVBQXhCLEVBQXlDTCxnQkFBekMsQ0FBMEQsT0FBMUQsRUFBbUUsVUFBQUMsS0FBSyxFQUFJO0FBQ3hFckIsZ0JBQVksQ0FBQyxDQUFDLGtCQUFELENBQUQsRUFBdUIsQ0FBQyxTQUFELENBQXZCLEVBQW9DLGFBQXBDLENBQVo7QUFFSCxHQUhEO0FBSUgsQ0FQRDs7QUFTQThCLHNCQUFzQixHLENBT3RCO0FBQ0EsaUIiLCJmaWxlIjoiL2pzL2dyYXBoczIuanMiLCJzb3VyY2VzQ29udGVudCI6WyIgXHQvLyBUaGUgbW9kdWxlIGNhY2hlXG4gXHR2YXIgaW5zdGFsbGVkTW9kdWxlcyA9IHt9O1xuXG4gXHQvLyBUaGUgcmVxdWlyZSBmdW5jdGlvblxuIFx0ZnVuY3Rpb24gX193ZWJwYWNrX3JlcXVpcmVfXyhtb2R1bGVJZCkge1xuXG4gXHRcdC8vIENoZWNrIGlmIG1vZHVsZSBpcyBpbiBjYWNoZVxuIFx0XHRpZihpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSkge1xuIFx0XHRcdHJldHVybiBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXS5leHBvcnRzO1xuIFx0XHR9XG4gXHRcdC8vIENyZWF0ZSBhIG5ldyBtb2R1bGUgKGFuZCBwdXQgaXQgaW50byB0aGUgY2FjaGUpXG4gXHRcdHZhciBtb2R1bGUgPSBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSA9IHtcbiBcdFx0XHRpOiBtb2R1bGVJZCxcbiBcdFx0XHRsOiBmYWxzZSxcbiBcdFx0XHRleHBvcnRzOiB7fVxuIFx0XHR9O1xuXG4gXHRcdC8vIEV4ZWN1dGUgdGhlIG1vZHVsZSBmdW5jdGlvblxuIFx0XHRtb2R1bGVzW21vZHVsZUlkXS5jYWxsKG1vZHVsZS5leHBvcnRzLCBtb2R1bGUsIG1vZHVsZS5leHBvcnRzLCBfX3dlYnBhY2tfcmVxdWlyZV9fKTtcblxuIFx0XHQvLyBGbGFnIHRoZSBtb2R1bGUgYXMgbG9hZGVkXG4gXHRcdG1vZHVsZS5sID0gdHJ1ZTtcblxuIFx0XHQvLyBSZXR1cm4gdGhlIGV4cG9ydHMgb2YgdGhlIG1vZHVsZVxuIFx0XHRyZXR1cm4gbW9kdWxlLmV4cG9ydHM7XG4gXHR9XG5cblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGVzIG9iamVjdCAoX193ZWJwYWNrX21vZHVsZXNfXylcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubSA9IG1vZHVsZXM7XG5cbiBcdC8vIGV4cG9zZSB0aGUgbW9kdWxlIGNhY2hlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmMgPSBpbnN0YWxsZWRNb2R1bGVzO1xuXG4gXHQvLyBkZWZpbmUgZ2V0dGVyIGZ1bmN0aW9uIGZvciBoYXJtb255IGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uZCA9IGZ1bmN0aW9uKGV4cG9ydHMsIG5hbWUsIGdldHRlcikge1xuIFx0XHRpZighX193ZWJwYWNrX3JlcXVpcmVfXy5vKGV4cG9ydHMsIG5hbWUpKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIG5hbWUsIHsgZW51bWVyYWJsZTogdHJ1ZSwgZ2V0OiBnZXR0ZXIgfSk7XG4gXHRcdH1cbiBcdH07XG5cbiBcdC8vIGRlZmluZSBfX2VzTW9kdWxlIG9uIGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uciA9IGZ1bmN0aW9uKGV4cG9ydHMpIHtcbiBcdFx0aWYodHlwZW9mIFN5bWJvbCAhPT0gJ3VuZGVmaW5lZCcgJiYgU3ltYm9sLnRvU3RyaW5nVGFnKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIFN5bWJvbC50b1N0cmluZ1RhZywgeyB2YWx1ZTogJ01vZHVsZScgfSk7XG4gXHRcdH1cbiBcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsICdfX2VzTW9kdWxlJywgeyB2YWx1ZTogdHJ1ZSB9KTtcbiBcdH07XG5cbiBcdC8vIGNyZWF0ZSBhIGZha2UgbmFtZXNwYWNlIG9iamVjdFxuIFx0Ly8gbW9kZSAmIDE6IHZhbHVlIGlzIGEgbW9kdWxlIGlkLCByZXF1aXJlIGl0XG4gXHQvLyBtb2RlICYgMjogbWVyZ2UgYWxsIHByb3BlcnRpZXMgb2YgdmFsdWUgaW50byB0aGUgbnNcbiBcdC8vIG1vZGUgJiA0OiByZXR1cm4gdmFsdWUgd2hlbiBhbHJlYWR5IG5zIG9iamVjdFxuIFx0Ly8gbW9kZSAmIDh8MTogYmVoYXZlIGxpa2UgcmVxdWlyZVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy50ID0gZnVuY3Rpb24odmFsdWUsIG1vZGUpIHtcbiBcdFx0aWYobW9kZSAmIDEpIHZhbHVlID0gX193ZWJwYWNrX3JlcXVpcmVfXyh2YWx1ZSk7XG4gXHRcdGlmKG1vZGUgJiA4KSByZXR1cm4gdmFsdWU7XG4gXHRcdGlmKChtb2RlICYgNCkgJiYgdHlwZW9mIHZhbHVlID09PSAnb2JqZWN0JyAmJiB2YWx1ZSAmJiB2YWx1ZS5fX2VzTW9kdWxlKSByZXR1cm4gdmFsdWU7XG4gXHRcdHZhciBucyA9IE9iamVjdC5jcmVhdGUobnVsbCk7XG4gXHRcdF9fd2VicGFja19yZXF1aXJlX18ucihucyk7XG4gXHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShucywgJ2RlZmF1bHQnLCB7IGVudW1lcmFibGU6IHRydWUsIHZhbHVlOiB2YWx1ZSB9KTtcbiBcdFx0aWYobW9kZSAmIDIgJiYgdHlwZW9mIHZhbHVlICE9ICdzdHJpbmcnKSBmb3IodmFyIGtleSBpbiB2YWx1ZSkgX193ZWJwYWNrX3JlcXVpcmVfXy5kKG5zLCBrZXksIGZ1bmN0aW9uKGtleSkgeyByZXR1cm4gdmFsdWVba2V5XTsgfS5iaW5kKG51bGwsIGtleSkpO1xuIFx0XHRyZXR1cm4gbnM7XG4gXHR9O1xuXG4gXHQvLyBnZXREZWZhdWx0RXhwb3J0IGZ1bmN0aW9uIGZvciBjb21wYXRpYmlsaXR5IHdpdGggbm9uLWhhcm1vbnkgbW9kdWxlc1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5uID0gZnVuY3Rpb24obW9kdWxlKSB7XG4gXHRcdHZhciBnZXR0ZXIgPSBtb2R1bGUgJiYgbW9kdWxlLl9fZXNNb2R1bGUgP1xuIFx0XHRcdGZ1bmN0aW9uIGdldERlZmF1bHQoKSB7IHJldHVybiBtb2R1bGVbJ2RlZmF1bHQnXTsgfSA6XG4gXHRcdFx0ZnVuY3Rpb24gZ2V0TW9kdWxlRXhwb3J0cygpIHsgcmV0dXJuIG1vZHVsZTsgfTtcbiBcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5kKGdldHRlciwgJ2EnLCBnZXR0ZXIpO1xuIFx0XHRyZXR1cm4gZ2V0dGVyO1xuIFx0fTtcblxuIFx0Ly8gT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm8gPSBmdW5jdGlvbihvYmplY3QsIHByb3BlcnR5KSB7IHJldHVybiBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwob2JqZWN0LCBwcm9wZXJ0eSk7IH07XG5cbiBcdC8vIF9fd2VicGFja19wdWJsaWNfcGF0aF9fXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnAgPSBcIi9cIjtcblxuXG4gXHQvLyBMb2FkIGVudHJ5IG1vZHVsZSBhbmQgcmV0dXJuIGV4cG9ydHNcbiBcdHJldHVybiBfX3dlYnBhY2tfcmVxdWlyZV9fKF9fd2VicGFja19yZXF1aXJlX18ucyA9IDMpO1xuIiwiXG4vLyBkYkNvbHVtbnNUb0NyZWF0ZVNlbGVjdHNGb3I6IFttYWluX2FjdGl2aXRpZXMsc3ViX2FjdGl2aXRpZXMsbWFpbl9zdWJfb3B0aW9uc10vIFtzY2FsZWRfYWN0aXZpdGllc11cbi8vIG5hbWVJZHNGb3JTZWxlY3Q6IFttYWluZElELHN1YklkLG9wdGlvbklkXS9bc2NhbGVkX2lkXVxuLy8gZGl2SWRUb0FkZFJvd1RvOiBtYWluU3ViUm93RGl2XG5cbi8vIGNvbnN0IGFkZFNlbGVjdFJvdyA9IChkYkNvbHVtblRvQ3JlYXRlU2VsZWN0c0ZvcixuYW1lSWRzRm9yU2VsZWN0LGRpdklkVG9BZGRSb3dUbykgPT57XG4vLyAgICAgLWNyZWF0ZSBuZXdSb3dJbnB1dERpdlxuLy8gICAgIC1jcmVhdGUgZm9yIGVhY2ggZGIgY29sdW0gaW4gZGJDb2x1bW5zVG9DcmVhdGVTZWxlY3RzRm9yIGFuIHNlbGVjdCBhbmQgYWRkIG9wdGlvbnMoaWQgYW5kIG5hbWUpICsgY3JlYXRlIGFuIGRlbGV0ZSBidXR0b24vIGV2ZW50LnRhcmdldC5wYXJlbnROb2RlLnJlbW92ZSgpXG4vLyAgICAgLWFkZCBhbGwgY3JlYXRlZCBzZWxlY3QgdG8gbmV3Um93SW5wdXREaXZcbi8vICAgICAtYWRkIG5ld1Jvd0lucHV0RGl2IHRvICBkaXZJZFRvQWRkUm93VG9cblxuXG5jb25zdCBhZGRTZWxlY3RSb3cgPSAoZGJDb2x1bW5zVG9DcmVhdGVTZWxlY3RGb3IsIG5hbWVJZHNGb3JTZWxlY3QsIGRpdklkVG9BZGRSb3dUbykgPT4ge1xuICAgIGxldCBuZXdSb3dEaXYgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KFwiZGl2XCIpO1xuXG4gICAgZGJDb2x1bW5zVG9DcmVhdGVTZWxlY3RGb3IuZm9yRWFjaCgoZGJDb2x1bW5OYW1lLCBpbmRleCkgPT4ge1xuICAgICAgICBsZXQgbmV3U2VsZWN0ID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudChcInNlbGVjdFwiKTtcbiAgICAgICAgbmV3U2VsZWN0LnNldEF0dHJpYnV0ZShcIm5hbWVcIiwgbmFtZUlkc0ZvclNlbGVjdFtpbmRleF0pXG5cbiAgICAgICAgdGltZXJEYXRhW2RiQ29sdW1uTmFtZV0uZm9yRWFjaChzZWxlY3RPcHRpb24gPT4ge1xuICAgICAgICAgICAgbGV0IG5ld09wdGlvbiA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoXCJvcHRpb25cIik7XG4gICAgICAgICAgICBuZXdPcHRpb24udmFsdWUgPSBzZWxlY3RPcHRpb25bXCJpZFwiXTtcbiAgICAgICAgICAgIG5ld09wdGlvbi50ZXh0ID0gc2VsZWN0T3B0aW9uW1wibmFtZVwiXTtcbiAgICAgICAgICAgIG5ld1NlbGVjdC5hcHBlbmRDaGlsZChuZXdPcHRpb24pO1xuICAgICAgICB9KTtcbiAgICAgICAgbmV3Um93RGl2LmFwcGVuZENoaWxkKG5ld1NlbGVjdClcblxuICAgIH0pO1xuXG5cbiAgICBsZXQgZGVsZXRlQnV0dG9uID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudChcImJ1dHRvblwiKTtcbiAgICBkZWxldGVCdXR0b24udGV4dENvbnRlbnQ9XCJkZWxldGUgcm93XCJcbiAgICBkZWxldGVCdXR0b24uYWRkRXZlbnRMaXN0ZW5lcihcImNsaWNrXCIsIGV2ZW50ID0+IHtcbiAgICAgICAgZXZlbnQudGFyZ2V0LnBhcmVudE5vZGUucmVtb3ZlKClcbiAgICB9KTtcblxuICAgIG5ld1Jvd0Rpdi5hcHBlbmRDaGlsZChkZWxldGVCdXR0b24pXG5cbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChkaXZJZFRvQWRkUm93VG8pLmFwcGVuZENoaWxkKG5ld1Jvd0RpdilcblxuXG5cbn1cblxuXG5cblxuXG5cblxuXG5jb25zdCBjcmVhdGVOZXdNYWluU3ViSW5wdXRSb3cgPSAoKSA9PiB7XG5cblxuICAgIGNvbnN0IG1haW5TdWJSb3dPcHRpb25zID1cbiAgICBbXG4gICAgICAgIHtcbiAgICAgICAgICAgIFwiaWRcIjogMCxcbiAgICAgICAgICAgIFwibmFtZVwiOiBcInRvdGFsIHRpbWVcIlxuICAgICAgICB9LFxuICAgICAgICB7XG4gICAgICAgICAgICBcImlkXCI6IDEsXG4gICAgICAgICAgICBcIm5hbWVcIjogXCJhdmVyYWdlIGxvZyB0aW1lXCJcbiAgICAgICAgfVxuXG5cbiAgICBdXG5cbiAgICB0aW1lckRhdGFbXCJzdWJfYWN0aXZpdGllc1wiXS5wdXNoKCAge1xuICAgICAgICBcImlkXCI6IDk5OTksXG4gICAgICAgIFwibmFtZVwiOiBcIkFsbFwiXG4gICAgfSlcblxuICAgIHRpbWVyRGF0YVtcIm1haW5fc3ViX29wdGlvbnNcIl0gPSBtYWluU3ViUm93T3B0aW9uc1xuXG5cbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImFkZE1haW5TdWJJbnB1dFwiKS5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgZXZlbnQgPT4ge1xuICAgICAgICBhZGRTZWxlY3RSb3coW1wibWFpbl9hY3Rpdml0aWVzXCIsIFwic3ViX2FjdGl2aXRpZXNcIiwgXCJtYWluX3N1Yl9vcHRpb25zXCJdLCBbXCJtYWluSWRcIiwgXCJzdWJJZFwiLCBcIm9wdGlvbklkXCJdLCBcIm1haW5TdWJJbnB1dHNcIilcblxuICAgIH0pO1xufVxuXG5jcmVhdGVOZXdNYWluU3ViSW5wdXRSb3coKVxuXG5cbmNvbnN0IGNyZWF0ZU5ld1NjYWxlZElucHV0Um93ID0gKCkgPT4ge1xuXG5cbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcImFkZFNjYWxlZElucHV0XCIpLmFkZEV2ZW50TGlzdGVuZXIoXCJjbGlja1wiLCBldmVudCA9PiB7XG4gICAgICAgIGFkZFNlbGVjdFJvdyhbXCJzY2FsZWRfYWN0aXZpdGllc1wiXSwgW1wic2NhbGVkSWRcIl0sIFwic2NhbGVkSW5wdXRzXCIpXG5cbiAgICB9KTtcbn1cblxuY3JlYXRlTmV3U2NhbGVkSW5wdXRSb3coKVxuXG5cbmNvbnN0IGNyZWF0ZU5ld0ZpeGVkSW5wdXRSb3cgPSAoKSA9PiB7XG5cblxuICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwiYWRkRml4ZWRJbnB1dFwiKS5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgZXZlbnQgPT4ge1xuICAgICAgICBhZGRTZWxlY3RSb3coW1wiZml4ZWRfYWN0aXZpdGllc1wiXSwgW1wiZml4ZWRJZFwiXSwgXCJmaXhlZElucHV0c1wiKVxuXG4gICAgfSk7XG59XG5cbmNyZWF0ZU5ld0ZpeGVkSW5wdXRSb3coKVxuXG5cblxuXG5cblxuLy8gc2NhbGVkSW5wdXRzXG4vLyBhZGRTY2FsZWRJbnB1dFxuIl0sInNvdXJjZVJvb3QiOiIifQ==