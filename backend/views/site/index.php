<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
use backend\assets\AppAsset;
AppAsset::addScript($this,'@web/js/echarts.min.js');
AppAsset::addScript($this,'@web/js/timelineGDP.js');
AppAsset::addScript($this,'@web/js/draggable.js');


$this->registerJs(<<<JS
$(function() {


        var myChart0 = echarts.init(document.getElementById('main0'));
        var myChart = echarts.init(document.getElementById('main'));
        var myChart1 = echarts.init(document.getElementById('main1'));
        var myChart2 = echarts.init(document.getElementById('main2'));
        var myChart3 = echarts.init(document.getElementById('main3'));
        var myChart4 = echarts.init(document.getElementById('main4'));
        var myChart5 = echarts.init(document.getElementById('main5'));

        function randomData() {
            now = new Date(+now + oneDay);
            value = value + Math.random() * 21 - 10;
            return {
                name: now.toString(),
                value: [
                    [now.getFullYear(), now.getMonth() + 1, now.getDate()].join('/'),
                    Math.round(value)
                ]
            }
        }
        
        var data = [];
        var now = +new Date(1997, 9, 3);
        var oneDay = 24 * 3600 * 1000;
        var value = Math.random() * 1000;
        for (var i = 0; i < 1000; i++) {
            data.push(randomData());
        }
        myChart.setOption({
            title: {
                text: '动态数据 + 时间坐标轴'
            },
            tooltip: {
                trigger: 'axis',
                formatter: function (params) {
                    params = params[0];
                    var date = new Date(params.name);
                    return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear() + ' : ' + params.value[1];
                },
                axisPointer: {
                    animation: false
                }
            },
            xAxis: {
                type: 'time',
                splitLine: {
                    show: false
                }
            },
            yAxis: {
                type: 'value',
                boundaryGap: [0, '100%'],
                splitLine: {
                    show: false
                }
            },
            series: [{
                name: '模拟数据',
                type: 'line',
                showSymbol: false,
                hoverAnimation: false,
                data: data
            }]
        });

        setInterval(function () {
        
            for (var i = 0; i < 5; i++) {
                data.shift();
                data.push(randomData());
            }
        
            myChart.setOption({
                series: [{
                    data: data
                }]
            });
        }, 1000);

  
        myChart2.setOption({
            backgroundColor: '#2c343c',
            visualMap: {
                show: false,
                min: 80,
                max: 600,
                inRange: {
                    colorLightness: [0, 1]
                }
            },
            series : [
                {
                    name: '访问来源',
                    type: 'pie',
                    radius: '55%',
                    data:[
                        {value:235, name:'视频广告'},
                        {value:274, name:'联盟广告'},
                        {value:310, name:'邮件营销'},
                        {value:335, name:'直接访问'},
                        {value:400, name:'搜索引擎'}
                    ],
                    roseType: 'angle',
                    label: {
                        normal: {
                            textStyle: {
                                color: 'rgba(255, 255, 255, 0.3)'
                            }
                        }
                    },
                    labelLine: {
                        normal: {
                            lineStyle: {
                                color: 'rgba(255, 255, 255, 0.3)'
                            }
                        }
                    },
                    itemStyle: {
                        normal: {
                            color: '#c23531',
                            shadowBlur: 200,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        });




//myChart1开始
// Schema:
// date,AQIindex,PM2.5,PM10,CO,NO2,SO2
var dataBJ = [
    [1,55,9,56,0.46,18,6,"良"],
    [2,25,11,21,0.65,34,9,"优"],
    [3,56,7,63,0.3,14,5,"良"],
    [4,33,7,29,0.33,16,6,"优"],
    [5,42,24,44,0.76,40,16,"优"],
    [6,82,58,90,1.77,68,33,"良"],
    [7,74,49,77,1.46,48,27,"良"],
    [8,78,55,80,1.29,59,29,"良"],
    [9,267,216,280,4.8,108,64,"重度污染"],
    [10,185,127,216,2.52,61,27,"中度污染"],
    [11,39,19,38,0.57,31,15,"优"],
    [12,41,11,40,0.43,21,7,"优"],
    [13,64,38,74,1.04,46,22,"良"],
    [14,108,79,120,1.7,75,41,"轻度污染"],
    [15,108,63,116,1.48,44,26,"轻度污染"],
    [16,33,6,29,0.34,13,5,"优"],
    [17,94,66,110,1.54,62,31,"良"],
    [18,186,142,192,3.88,93,79,"中度污染"],
    [19,57,31,54,0.96,32,14,"良"],
    [20,22,8,17,0.48,23,10,"优"],
    [21,39,15,36,0.61,29,13,"优"],
    [22,94,69,114,2.08,73,39,"良"],
    [23,99,73,110,2.43,76,48,"良"],
    [24,31,12,30,0.5,32,16,"优"],
    [25,42,27,43,1,53,22,"优"],
    [26,154,117,157,3.05,92,58,"中度污染"],
    [27,234,185,230,4.09,123,69,"重度污染"],
    [28,160,120,186,2.77,91,50,"中度污染"],
    [29,134,96,165,2.76,83,41,"轻度污染"],
    [30,52,24,60,1.03,50,21,"良"],
    [31,46,5,49,0.28,10,6,"优"]
];

var dataGZ = [
    [1,26,37,27,1.163,27,13,"优"],
    [2,85,62,71,1.195,60,8,"良"],
    [3,78,38,74,1.363,37,7,"良"],
    [4,21,21,36,0.634,40,9,"优"],
    [5,41,42,46,0.915,81,13,"优"],
    [6,56,52,69,1.067,92,16,"良"],
    [7,64,30,28,0.924,51,2,"良"],
    [8,55,48,74,1.236,75,26,"良"],
    [9,76,85,113,1.237,114,27,"良"],
    [10,91,81,104,1.041,56,40,"良"],
    [11,84,39,60,0.964,25,11,"良"],
    [12,64,51,101,0.862,58,23,"良"],
    [13,70,69,120,1.198,65,36,"良"],
    [14,77,105,178,2.549,64,16,"良"],
    [15,109,68,87,0.996,74,29,"轻度污染"],
    [16,73,68,97,0.905,51,34,"良"],
    [17,54,27,47,0.592,53,12,"良"],
    [18,51,61,97,0.811,65,19,"良"],
    [19,91,71,121,1.374,43,18,"良"],
    [20,73,102,182,2.787,44,19,"良"],
    [21,73,50,76,0.717,31,20,"良"],
    [22,84,94,140,2.238,68,18,"良"],
    [23,93,77,104,1.165,53,7,"良"],
    [24,99,130,227,3.97,55,15,"良"],
    [25,146,84,139,1.094,40,17,"轻度污染"],
    [26,113,108,137,1.481,48,15,"轻度污染"],
    [27,81,48,62,1.619,26,3,"良"],
    [28,56,48,68,1.336,37,9,"良"],
    [29,82,92,174,3.29,0,13,"良"],
    [30,106,116,188,3.628,101,16,"轻度污染"],
    [31,118,50,0,1.383,76,11,"轻度污染"]
];

var dataSH = [
    [1,91,45,125,0.82,34,23,"良"],
    [2,65,27,78,0.86,45,29,"良"],
    [3,83,60,84,1.09,73,27,"良"],
    [4,109,81,121,1.28,68,51,"轻度污染"],
    [5,106,77,114,1.07,55,51,"轻度污染"],
    [6,109,81,121,1.28,68,51,"轻度污染"],
    [7,106,77,114,1.07,55,51,"轻度污染"],
    [8,89,65,78,0.86,51,26,"良"],
    [9,53,33,47,0.64,50,17,"良"],
    [10,80,55,80,1.01,75,24,"良"],
    [11,117,81,124,1.03,45,24,"轻度污染"],
    [12,99,71,142,1.1,62,42,"良"],
    [13,95,69,130,1.28,74,50,"良"],
    [14,116,87,131,1.47,84,40,"轻度污染"],
    [15,108,80,121,1.3,85,37,"轻度污染"],
    [16,134,83,167,1.16,57,43,"轻度污染"],
    [17,79,43,107,1.05,59,37,"良"],
    [18,71,46,89,0.86,64,25,"良"],
    [19,97,71,113,1.17,88,31,"良"],
    [20,84,57,91,0.85,55,31,"良"],
    [21,87,63,101,0.9,56,41,"良"],
    [22,104,77,119,1.09,73,48,"轻度污染"],
    [23,87,62,100,1,72,28,"良"],
    [24,168,128,172,1.49,97,56,"中度污染"],
    [25,65,45,51,0.74,39,17,"良"],
    [26,39,24,38,0.61,47,17,"优"],
    [27,39,24,39,0.59,50,19,"优"],
    [28,93,68,96,1.05,79,29,"良"],
    [29,188,143,197,1.66,99,51,"中度污染"],
    [30,174,131,174,1.55,108,50,"中度污染"],
    [31,187,143,201,1.39,89,53,"中度污染"]
];

var schema = [
    {name: 'date', index: 0, text: '日期'},
    {name: 'AQIindex', index: 1, text: 'AQI'},
    {name: 'PM25', index: 2, text: 'PM2.5'},
    {name: 'PM10', index: 3, text: 'PM10'},
    {name: 'CO', index: 4, text: ' CO'},
    {name: 'NO2', index: 5, text: 'NO2'},
    {name: 'SO2', index: 6, text: 'SO2'},
    {name: '等级', index: 7, text: '等级'}
];

var lineStyle = {
    normal: {
        width: 1,
        opacity: 0.5
    }
};

myChart1.setOption({
    backgroundColor: '#333',
    legend: {
        bottom: 30,
        data: ['北京', '上海', '广州'],
        itemGap: 20,
        textStyle: {
            color: '#fff',
            fontSize: 14
        }
    },
    tooltip: {
        padding: 10,
        backgroundColor: '#222',
        borderColor: '#777',
        borderWidth: 1,
        formatter: function (obj) {
            var value = obj[0].value;
            return '<div style="border-bottom: 1px solid rgba(255,255,255,.3); font-size: 18px;padding-bottom: 7px;margin-bottom: 7px">'
                + obj[0].seriesName + ' ' + value[0] + '日期：'
                + value[7]
                + '</div>'
                + schema[1].text + '：' + value[1] + '<br>'
                + schema[2].text + '：' + value[2] + '<br>'
                + schema[3].text + '：' + value[3] + '<br>'
                + schema[4].text + '：' + value[4] + '<br>'
                + schema[5].text + '：' + value[5] + '<br>'
                + schema[6].text + '：' + value[6] + '<br>';
        }
    },
    // dataZoom: {
    //     show: true,
    //     orient: 'vertical',
    //     parallelAxisIndex: [0]
    // },
    parallelAxis: [
        {dim: 0, name: schema[0].text, inverse: true, max: 31, nameLocation: 'start'},
        {dim: 1, name: schema[1].text},
        {dim: 2, name: schema[2].text},
        {dim: 3, name: schema[3].text},
        {dim: 4, name: schema[4].text},
        {dim: 5, name: schema[5].text},
        {dim: 6, name: schema[6].text},
        {dim: 7, name: schema[7].text,
        type: 'category', data: ['优', '良', '轻度污染', '中度污染', '重度污染', '严重污染']}
    ],
    visualMap: {
        show: true,
        min: 0,
        max: 150,
        dimension: 2,
        inRange: {
            color: ['#d94e5d','#eac736','#50a3ba'].reverse(),
            // colorAlpha: [0, 1]
        }
    },
    parallel: {
        left: '5%',
        right: '18%',
        bottom: 100,
        parallelAxisDefault: {
            type: 'value',
            name: 'AQI指数',
            nameLocation: 'end',
            nameGap: 20,
            nameTextStyle: {
                color: '#fff',
                fontSize: 12
            },
            axisLine: {
                lineStyle: {
                    color: '#aaa'
                }
            },
            axisTick: {
                lineStyle: {
                    color: '#777'
                }
            },
            splitLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#fff'
                }
            }
        }
    },
    series: [
        {
            name: '北京',
            type: 'parallel',
            lineStyle: lineStyle,
            data: dataBJ
        },
        {
            name: '上海',
            type: 'parallel',
            lineStyle: lineStyle,
            data: dataSH
        },
        {
            name: '广州',
            type: 'parallel',
            lineStyle: lineStyle,
            data: dataGZ
        }
    ]
});

//myChart1结束


//myChart3开始
// 数据意义：开盘(open)，收盘(close)，最低(lowest)，最高(highest)
var data0 = splitData([
    ['2013/1/24', 2320.26,2320.26,2287.3,2362.94],
    ['2013/1/25', 2300,2291.3,2288.26,2308.38],
    ['2013/1/28', 2295.35,2346.5,2295.35,2346.92],
    ['2013/1/29', 2347.22,2358.98,2337.35,2363.8],
    ['2013/1/30', 2360.75,2382.48,2347.89,2383.76],
    ['2013/1/31', 2383.43,2385.42,2371.23,2391.82],
    ['2013/2/1', 2377.41,2419.02,2369.57,2421.15],
    ['2013/2/4', 2425.92,2428.15,2417.58,2440.38],
    ['2013/2/5', 2411,2433.13,2403.3,2437.42],
    ['2013/2/6', 2432.68,2434.48,2427.7,2441.73],
    ['2013/2/7', 2430.69,2418.53,2394.22,2433.89],
    ['2013/2/8', 2416.62,2432.4,2414.4,2443.03],
    ['2013/2/18', 2441.91,2421.56,2415.43,2444.8],
    ['2013/2/19', 2420.26,2382.91,2373.53,2427.07],
    ['2013/2/20', 2383.49,2397.18,2370.61,2397.94],
    ['2013/2/21', 2378.82,2325.95,2309.17,2378.82],
    ['2013/2/22', 2322.94,2314.16,2308.76,2330.88],
    ['2013/2/25', 2320.62,2325.82,2315.01,2338.78],
    ['2013/2/26', 2313.74,2293.34,2289.89,2340.71],
    ['2013/2/27', 2297.77,2313.22,2292.03,2324.63],
    ['2013/2/28', 2322.32,2365.59,2308.92,2366.16],
    ['2013/3/1', 2364.54,2359.51,2330.86,2369.65],
    ['2013/3/4', 2332.08,2273.4,2259.25,2333.54],
    ['2013/3/5', 2274.81,2326.31,2270.1,2328.14],
    ['2013/3/6', 2333.61,2347.18,2321.6,2351.44],
    ['2013/3/7', 2340.44,2324.29,2304.27,2352.02],
    ['2013/3/8', 2326.42,2318.61,2314.59,2333.67],
    ['2013/3/11', 2314.68,2310.59,2296.58,2320.96],
    ['2013/3/12', 2309.16,2286.6,2264.83,2333.29],
    ['2013/3/13', 2282.17,2263.97,2253.25,2286.33],
    ['2013/3/14', 2255.77,2270.28,2253.31,2276.22],
    ['2013/3/15', 2269.31,2278.4,2250,2312.08],
    ['2013/3/18', 2267.29,2240.02,2239.21,2276.05],
    ['2013/3/19', 2244.26,2257.43,2232.02,2261.31],
    ['2013/3/20', 2257.74,2317.37,2257.42,2317.86],
    ['2013/3/21', 2318.21,2324.24,2311.6,2330.81],
    ['2013/3/22', 2321.4,2328.28,2314.97,2332],
    ['2013/3/25', 2334.74,2326.72,2319.91,2344.89],
    ['2013/3/26', 2318.58,2297.67,2281.12,2319.99],
    ['2013/3/27', 2299.38,2301.26,2289,2323.48],
    ['2013/3/28', 2273.55,2236.3,2232.91,2273.55],
    ['2013/3/29', 2238.49,2236.62,2228.81,2246.87],
    ['2013/4/1', 2229.46,2234.4,2227.31,2243.95],
    ['2013/4/2', 2234.9,2227.74,2220.44,2253.42],
    ['2013/4/3', 2232.69,2225.29,2217.25,2241.34],
    ['2013/4/8', 2196.24,2211.59,2180.67,2212.59],
    ['2013/4/9', 2215.47,2225.77,2215.47,2234.73],
    ['2013/4/10', 2224.93,2226.13,2212.56,2233.04],
    ['2013/4/11', 2236.98,2219.55,2217.26,2242.48],
    ['2013/4/12', 2218.09,2206.78,2204.44,2226.26],
    ['2013/4/15', 2199.91,2181.94,2177.39,2204.99],
    ['2013/4/16', 2169.63,2194.85,2165.78,2196.43],
    ['2013/4/17', 2195.03,2193.8,2178.47,2197.51],
    ['2013/4/18', 2181.82,2197.6,2175.44,2206.03],
    ['2013/4/19', 2201.12,2244.64,2200.58,2250.11],
    ['2013/4/22', 2236.4,2242.17,2232.26,2245.12],
    ['2013/4/23', 2242.62,2184.54,2182.81,2242.62],
    ['2013/4/24', 2187.35,2218.32,2184.11,2226.12],
    ['2013/4/25', 2213.19,2199.31,2191.85,2224.63],
    ['2013/4/26', 2203.89,2177.91,2173.86,2210.58],
    ['2013/5/2', 2170.78,2174.12,2161.14,2179.65],
    ['2013/5/3', 2179.05,2205.5,2179.05,2222.81],
    ['2013/5/6', 2212.5,2231.17,2212.5,2236.07],
    ['2013/5/7', 2227.86,2235.57,2219.44,2240.26],
    ['2013/5/8', 2242.39,2246.3,2235.42,2255.21],
    ['2013/5/9', 2246.96,2232.97,2221.38,2247.86],
    ['2013/5/10', 2228.82,2246.83,2225.81,2247.67],
    ['2013/5/13', 2247.68,2241.92,2231.36,2250.85],
    ['2013/5/14', 2238.9,2217.01,2205.87,2239.93],
    ['2013/5/15', 2217.09,2224.8,2213.58,2225.19],
    ['2013/5/16', 2221.34,2251.81,2210.77,2252.87],
    ['2013/5/17', 2249.81,2282.87,2248.41,2288.09],
    ['2013/5/20', 2286.33,2299.99,2281.9,2309.39],
    ['2013/5/21', 2297.11,2305.11,2290.12,2305.3],
    ['2013/5/22', 2303.75,2302.4,2292.43,2314.18],
    ['2013/5/23', 2293.81,2275.67,2274.1,2304.95],
    ['2013/5/24', 2281.45,2288.53,2270.25,2292.59],
    ['2013/5/27', 2286.66,2293.08,2283.94,2301.7],
    ['2013/5/28', 2293.4,2321.32,2281.47,2322.1],
    ['2013/5/29', 2323.54,2324.02,2321.17,2334.33],
    ['2013/5/30', 2316.25,2317.75,2310.49,2325.72],
    ['2013/5/31', 2320.74,2300.59,2299.37,2325.53],
    ['2013/6/3', 2300.21,2299.25,2294.11,2313.43],
    ['2013/6/4', 2297.1,2272.42,2264.76,2297.1],
    ['2013/6/5', 2270.71,2270.93,2260.87,2276.86],
    ['2013/6/6', 2264.43,2242.11,2240.07,2266.69],
    ['2013/6/7', 2242.26,2210.9,2205.07,2250.63],
    ['2013/6/13', 2190.1,2148.35,2126.22,2190.1]
]);
function splitData(rawData) {
    var categoryData = [];
    var values = []
    for (var i = 0; i < rawData.length; i++) {
        categoryData.push(rawData[i].splice(0, 1)[0]);
        values.push(rawData[i])
    }
    return {
        categoryData: categoryData,
        values: values
    };
}
function calculateMA(dayCount) {
    var result = [];
    for (var i = 0, len = data0.values.length; i < len; i++) {
        if (i < dayCount) {
            result.push('-');
            continue;
        }
        var sum = 0;
        for (var j = 0; j < dayCount; j++) {
            sum += data0.values[i - j][1];
        }
        result.push(sum / dayCount);
    }
    return result;
}
myChart3.setOption({
    title: {
        text: '上证指数',
        left: 0
    },
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'line'
        }
    },
    legend: {
        data: ['日K', 'MA5', 'MA10', 'MA20', 'MA30']
    },
    grid: {
        left: '10%',
        right: '10%',
        bottom: '15%'
    },
    xAxis: {
        type: 'category',
        data: data0.categoryData,
        scale: true,
        boundaryGap : false,
        axisLine: {onZero: false},
        splitLine: {show: false},
        splitNumber: 20,
        min: 'dataMin',
        max: 'dataMax'
    },
    yAxis: {
        scale: true,
        splitArea: {
            show: true
        }
    },
    dataZoom: [
        {
            type: 'inside',
            start: 50,
            end: 100
        },
        {
            show: true,
            type: 'slider',
            y: '90%',
            start: 50,
            end: 100
        }
    ],
    series: [
        {
            name: '日K',
            type: 'candlestick',
            data: data0.values,
            markPoint: {
                label: {
                    normal: {
                        formatter: function (param) {
                            return param != null ? Math.round(param.value) : '';
                        }
                    }
                },
                data: [
                    {
                        name: 'XX标点',
                        coord: ['2013/5/31', 2300],
                        value: 2300,
                        itemStyle: {
                            normal: {color: 'rgb(41,60,85)'}
                        }
                    },
                    {
                        name: 'highest value',
                        type: 'max',
                        valueDim: 'highest'
                    },
                    {
                        name: 'lowest value',
                        type: 'min',
                        valueDim: 'lowest'
                    },
                    {
                        name: 'average value on close',
                        type: 'average',
                        valueDim: 'close'
                    }
                ],
                tooltip: {
                    formatter: function (param) {
                        return param.name + '<br>' + (param.data.coord || '');
                    }
                }
            },
            markLine: {
                symbol: ['none', 'none'],
                data: [
                    [
                        {
                            name: 'from lowest to highest',
                            type: 'min',
                            valueDim: 'lowest',
                            symbol: 'circle',
                            symbolSize: 10,
                            label: {
                                normal: {show: false},
                                emphasis: {show: false}
                            }
                        },
                        {
                            type: 'max',
                            valueDim: 'highest',
                            symbol: 'circle',
                            symbolSize: 10,
                            label: {
                                normal: {show: false},
                                emphasis: {show: false}
                            }
                        }
                    ],
                    {
                        name: 'min line on close',
                        type: 'min',
                        valueDim: 'close'
                    },
                    {
                        name: 'max line on close',
                        type: 'max',
                        valueDim: 'close'
                    }
                ]
            }
        },
        {
            name: 'MA5',
            type: 'line',
            data: calculateMA(5),
            smooth: true,
            lineStyle: {
                normal: {opacity: 0.5}
            }
        },
        {
            name: 'MA10',
            type: 'line',
            data: calculateMA(10),
            smooth: true,
            lineStyle: {
                normal: {opacity: 0.5}
            }
        },
        {
            name: 'MA20',
            type: 'line',
            data: calculateMA(20),
            smooth: true,
            lineStyle: {
                normal: {opacity: 0.5}
            }
        },
        {
            name: 'MA30',
            type: 'line',
            data: calculateMA(30),
            smooth: true,
            lineStyle: {
                normal: {opacity: 0.5}
            }
        },

    ]
});
//myChart3结束






//myChart4开始

var uploadedDataURL = "json/ec-option-doc-statistics-201604.json";

myChart4.showLoading();

$.getJSON(uploadedDataURL, function (rawData) {

    myChart4.hideLoading();

    function convert(source, target, basePath) {
        for (var key in source) {
            var path = basePath ? (basePath + '.' + key) : key;
            if (key.match(/^\$/)) {

            }
            else {
                target.children = target.children || [];
                var child = {
                    name: path
                };
                target.children.push(child);
                convert(source[key], child, path);
            }
        }

        if (!target.children) {
            target.value = 1;
        }
        else {
            target.children.push({
                name: basePath,
                value: 1
            });
        }
    }

    var data = [];

    convert(rawData, data, '');

    myChart4.setOption(option = {
        title: {
            text: 'ECharts 配置项查询分布',
            subtext: '2016/04',
            left: 'leafDepth'
        },
        tooltip: {},
        series: [{
            name: 'option',
            type: 'treemap',
            visibleMin: 300,
            data: data.children,
            leafDepth: 2,
            levels: [
                {
                    itemStyle: {
                        normal: {
                            borderColor: '#555',
                            borderWidth: 4,
                            gapWidth: 4
                        }
                    }
                },
                {
                    colorSaturation: [0.3, 0.6],
                    itemStyle: {
                        normal: {
                            borderColorSaturation: 0.7,
                            gapWidth: 2,
                            borderWidth: 2
                        }
                    }
                },
                {
                    colorSaturation: [0.3, 0.5],
                    itemStyle: {
                        normal: {
                            borderColorSaturation: 0.6,
                            gapWidth: 1
                        }
                    }
                },
                {
                    colorSaturation: [0.3, 0.5]
                }
            ]
        }]
    })
});

//myChart4结束




//myChart5开始
myChart5.setOption({
    title: {
        text: '多雷达图'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        x: 'center',
        data:['某软件','某主食手机','某水果手机','降水量','蒸发量']
    },
    radar: [
        {
            indicator: [
                {text: '品牌', max: 100},
                {text: '内容', max: 100},
                {text: '可用性', max: 100},
                {text: '功能', max: 100}
            ],
            center: ['25%','40%'],
            radius: 80
        },
        {
            indicator: [
                {text: '外观', max: 100},
                {text: '拍照', max: 100},
                {text: '系统', max: 100},
                {text: '性能', max: 100},
                {text: '屏幕', max: 100}
            ],
            radius: 80,
            center: ['50%','60%'],
        },
        {
            indicator: (function (){
                var res = [];
                for (var i = 1; i <= 12; i++) {
                    res.push({text:i+'月',max:100});
                }
                return res;
            })(),
            center: ['75%','40%'],
            radius: 80
        }
    ],
    series: [
        {
            type: 'radar',
             tooltip: {
                trigger: 'item'
            },
            itemStyle: {normal: {areaStyle: {type: 'default'}}},
            data: [
                {
                    value: [60,73,85,40],
                    name: '某软件'
                }
            ]
        },
        {
            type: 'radar',
            radarIndex: 1,
            data: [
                {
                    value: [85, 90, 90, 95, 95],
                    name: '某主食手机'
                },
                {
                    value: [95, 80, 95, 90, 93],
                    name: '某水果手机'
                }
            ]
        },
        {
            type: 'radar',
            radarIndex: 2,
            itemStyle: {normal: {areaStyle: {type: 'default'}}},
            data: [
                {
                    name: '降水量',
                    value: [2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 75.6, 82.2, 48.7, 18.8, 6.0, 2.3],
                },
                {
                    name:'蒸发量',
                    value:[2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 35.6, 62.2, 32.6, 20.0, 6.4, 3.3]
                }
            ]
        }
    ]
});
//myChart5结束






//myChart0开始
            myChart0.hideLoading();

            var categoryData = [
                '北京','天津','河北','山西','内蒙古','辽宁','吉林','黑龙江',
                '上海','江苏','浙江','安徽','福建','江西','山东','河南',
                '湖北','湖南','广东','广西','海南','重庆','四川','贵州',
                '云南','西藏','陕西','甘肃','青海','宁夏','新疆'
            ];

            option = {
                baseOption: {
                    timeline: {
                        axisType: 'category',
                        autoPlay: true,
                        playInterval: 1000,
                        data: [
                            '2002-01-01', '2003-01-01', '2004-01-01',
                            '2005-01-01', '2006-01-01', '2007-01-01',
                            '2008-01-01', '2009-01-01', '2010-01-01',
                            '2011-01-01'
                        ],
                        label: {
                            formatter : function(s) {
                                return (new Date(s)).getFullYear();
                            }
                        }
                    },
                    title: {
                        subtext: 'Media Query 示例'
                    },
                    tooltip: {
                        trigger:'axis',
                        axisPointer: {
                            type: 'shadow'
                        }
                    },
                    xAxis: {
                        type: 'value',
                        name: 'GDP（亿元）',
                        max: 30000,
                        data: null
                    },
                    yAxis: {
                        type: 'category',
                        data: categoryData,
                        axisLabel: {interval: 0},
                        splitLine: {show: false}
                    },
                    legend: {
                        data: ['第一产业', '第二产业', '第三产业', 'GDP', '金融', '房地产'],
                        selected: {
                            'GDP': false, '金融': false, '房地产': false
                        }
                    },
                    calculable : true,
                    series: [
                        {name: 'GDP', type: 'bar'},
                        {name: '金融', type: 'bar'},
                        {name: '房地产', type: 'bar'},
                        {name: '第一产业', type: 'bar'},
                        {name: '第二产业', type: 'bar'},
                        {name: '第三产业', type: 'bar'},
                        {name: 'GDP占比', type: 'pie'}
                    ]
                },
                media: [
                    {
                        option: {
                            legend: {
                                orient: 'horizontal',
                                left: 'right',
                                itemGap: 10
                            },
                            grid: {
                                left: '10%',
                                top: 80,
                                right: 90,
                                bottom: 100
                            },
                            xAxis: {
                                nameLocation: 'end',
                                nameGap: 10,
                                splitNumber: 5,
                                splitLine: {
                                    show: true
                                }
                            },
                            timeline: {
                                orient: 'horizontal',
                                inverse: false,
                                left: '20%',
                                right: '20%',
                                bottom: 10,
                                height: 40
                            },
                            series: [
                                {name: 'GDP占比', center: ['75%', '30%'], radius: '28%'}
                            ]
                        }
                    },
                    {
                        query: {maxWidth: 670, minWidth: 550},
                        option: {
                            legend: {
                                orient: 'horizontal',
                                left: 200,
                                itemGap: 5
                            },
                            grid: {
                                left: '10%',
                                top: 80,
                                right: 90,
                                bottom: 100
                            },
                            xAxis: {
                                nameLocation: 'end',
                                nameGap: 10,
                                splitNumber: 5,
                                splitLine: {
                                    show: true
                                }
                            },
                            timeline: {
                                orient: 'horizontal',
                                inverse: false,
                                left: '20%',
                                right: '20%',
                                bottom: 10,
                                height: 40
                            },
                            series: [
                                {name: 'GDP占比', center: ['75%', '30%'], radius: '28%'}
                            ]
                        }
                    },
                    {
                        query: {maxWidth: 550},
                        option: {
                            legend: {
                                orient: 'vertical',
                                left: 'right',
                                itemGap: 5
                            },
                            grid: {
                                left: 55,
                                top: '32%',
                                right: 100,
                                bottom: 50
                            },
                            xAxis: {
                                nameLocation: 'middle',
                                nameGap: 25,
                                splitNumber: 3
                            },
                            timeline: {
                                orient: 'vertical',
                                inverse: true,
                                right: 10,
                                top: 150,
                                bottom: 10,
                                width: 55
                            },
                            series: [
                                {name: 'GDP占比', center: ['45%', '20%'], radius: '28%'}
                            ]
                        }
                    }
                ],
                options: [
                    {
                        title: {text: '2002全国宏观经济指标'},
                        series: [
                            {data: dataMap.dataGDP['2002']},
                            {data: dataMap.dataFinancial['2002']},
                            {data: dataMap.dataEstate['2002']},
                            {data: dataMap.dataPI['2002']},
                            {data: dataMap.dataSI['2002']},
                            {data: dataMap.dataTI['2002']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2002sum']},
                                {name: '第二产业', value: dataMap.dataSI['2002sum']},
                                {name: '第三产业', value: dataMap.dataTI['2002sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2003全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2003']},
                            {data: dataMap.dataFinancial['2003']},
                            {data: dataMap.dataEstate['2003']},
                            {data: dataMap.dataPI['2003']},
                            {data: dataMap.dataSI['2003']},
                            {data: dataMap.dataTI['2003']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2003sum']},
                                {name: '第二产业', value: dataMap.dataSI['2003sum']},
                                {name: '第三产业', value: dataMap.dataTI['2003sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2004全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2004']},
                            {data: dataMap.dataFinancial['2004']},
                            {data: dataMap.dataEstate['2004']},
                            {data: dataMap.dataPI['2004']},
                            {data: dataMap.dataSI['2004']},
                            {data: dataMap.dataTI['2004']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2004sum']},
                                {name: '第二产业', value: dataMap.dataSI['2004sum']},
                                {name: '第三产业', value: dataMap.dataTI['2004sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2005全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2005']},
                            {data: dataMap.dataFinancial['2005']},
                            {data: dataMap.dataEstate['2005']},
                            {data: dataMap.dataPI['2005']},
                            {data: dataMap.dataSI['2005']},
                            {data: dataMap.dataTI['2005']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2005sum']},
                                {name: '第二产业', value: dataMap.dataSI['2005sum']},
                                {name: '第三产业', value: dataMap.dataTI['2005sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2006全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2006']},
                            {data: dataMap.dataFinancial['2006']},
                            {data: dataMap.dataEstate['2006']},
                            {data: dataMap.dataPI['2006']},
                            {data: dataMap.dataSI['2006']},
                            {data: dataMap.dataTI['2006']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2006sum']},
                                {name: '第二产业', value: dataMap.dataSI['2006sum']},
                                {name: '第三产业', value: dataMap.dataTI['2006sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2007全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2007']},
                            {data: dataMap.dataFinancial['2007']},
                            {data: dataMap.dataEstate['2007']},
                            {data: dataMap.dataPI['2007']},
                            {data: dataMap.dataSI['2007']},
                            {data: dataMap.dataTI['2007']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2007sum']},
                                {name: '第二产业', value: dataMap.dataSI['2007sum']},
                                {name: '第三产业', value: dataMap.dataTI['2007sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2008全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2008']},
                            {data: dataMap.dataFinancial['2008']},
                            {data: dataMap.dataEstate['2008']},
                            {data: dataMap.dataPI['2008']},
                            {data: dataMap.dataSI['2008']},
                            {data: dataMap.dataTI['2008']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2008sum']},
                                {name: '第二产业', value: dataMap.dataSI['2008sum']},
                                {name: '第三产业', value: dataMap.dataTI['2008sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2009全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2009']},
                            {data: dataMap.dataFinancial['2009']},
                            {data: dataMap.dataEstate['2009']},
                            {data: dataMap.dataPI['2009']},
                            {data: dataMap.dataSI['2009']},
                            {data: dataMap.dataTI['2009']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2009sum']},
                                {name: '第二产业', value: dataMap.dataSI['2009sum']},
                                {name: '第三产业', value: dataMap.dataTI['2009sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2010全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2010']},
                            {data: dataMap.dataFinancial['2010']},
                            {data: dataMap.dataEstate['2010']},
                            {data: dataMap.dataPI['2010']},
                            {data: dataMap.dataSI['2010']},
                            {data: dataMap.dataTI['2010']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2010sum']},
                                {name: '第二产业', value: dataMap.dataSI['2010sum']},
                                {name: '第三产业', value: dataMap.dataTI['2010sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2011全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2011']},
                            {data: dataMap.dataFinancial['2011']},
                            {data: dataMap.dataEstate['2011']},
                            {data: dataMap.dataPI['2011']},
                            {data: dataMap.dataSI['2011']},
                            {data: dataMap.dataTI['2011']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2011sum']},
                                {name: '第二产业', value: dataMap.dataSI['2011sum']},
                                {name: '第三产业', value: dataMap.dataTI['2011sum']}
                            ]}
                        ]
                    }
                ]
            };

            myChart0.setOption(option);
//myChart0结束





});
JS
);

?>





 <div id="main" style="width: 50%;height:400px;float:left;"></div>
 <div id="main1" style="width: 50%;height:400px;float:left;"></div>
 <div id="main2" style="width: 50%;height:400px;float:left;"></div>
 <div id="main3" style="width: 50%;height:400px;float:left;"></div>
 <div id="main4" style="width: 50%;height:400px;float:left;"></div>
 <div id="main5" style="width: 50%;height:400px;float:left;"></div>
 <div id="main0" style="width: 100%;height:700px;float:left;"></div>


<!-- <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var myChart0 = echarts.init(document.getElementById('main0'));
        var myChart = echarts.init(document.getElementById('main'));
        var myChart1 = echarts.init(document.getElementById('main1'));
        var myChart2 = echarts.init(document.getElementById('main2'));
        var myChart3 = echarts.init(document.getElementById('main3'));
        var myChart4 = echarts.init(document.getElementById('main4'));

        var base = +new Date(2014, 9, 3);
        var oneDay = 24 * 3600 * 1000;
        var date = [];

        var data = [Math.random() * 150];
        var now = new Date(base);

        function addData(shift) {
            now = [now.getFullYear(), now.getMonth() + 1, now.getDate()].join('/');
            date.push(now);
            data.push((Math.random() - 0.4) * 10 + data[data.length - 1]);

            if (shift) {
                date.shift();
                data.shift();
            }

            now = new Date(+new Date(now) + oneDay);
        }

        for (var i = 1; i < 100; i++) {
            addData();
        }

        myChart.setOption({
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: date
            },
            yAxis: {
                boundaryGap: [0, '50%'],
                type: 'value'
            },
            series: [
                {
                    name:'成交',
                    type:'line',
                    smooth:true,
                    symbol: 'none',
                    stack: 'a',
                    areaStyle: {
                        normal: {}
                    },
                    data: data
                }
            ]
        });

        setInterval(function () {
            addData(true);
            myChart.setOption({
                xAxis: {
                    data: date
                },
                series: [{
                    name:'成交',
                    data: data
                }]
            });
        }, 500);


        myChart1.setOption({
            visualMap: {
                show: false,
                min: 0,
                max: 60,
                inRange: {
                    colorLightness: [0, 1]
                }
            },
            title: {
                text: 'ECharts 入门示例'
            },
            tooltip: {},
            legend: {
                data:['销量']
            },
            xAxis: {
                data: [
                    "衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"
                ]
            },
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data: [5, 20, 36, 10, 10, 20]
            }]
        });
        myChart2.setOption({
            backgroundColor: '#2c343c',
            visualMap: {
                show: false,
                min: 80,
                max: 600,
                inRange: {
                    colorLightness: [0, 1]
                }
            },
            series : [
                {
                    name: '访问来源',
                    type: 'pie',
                    radius: '55%',
                    data:[
                        {value:235, name:'视频广告'},
                        {value:274, name:'联盟广告'},
                        {value:310, name:'邮件营销'},
                        {value:335, name:'直接访问'},
                        {value:400, name:'搜索引擎'}
                    ],
                    roseType: 'angle',
                    label: {
                        normal: {
                            textStyle: {
                                color: 'rgba(255, 255, 255, 0.3)'
                            }
                        }
                    },
                    labelLine: {
                        normal: {
                            lineStyle: {
                                color: 'rgba(255, 255, 255, 0.3)'
                            }
                        }
                    },
                    itemStyle: {
                        normal: {
                            color: '#c23531',
                            shadowBlur: 200,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        });

        myChart3.setOption({
            backgroundColor: '#2c343c',
            visualMap: {
                show: false,
                min: 0,
                max: 6,
                inRange: {
                    colorLightness: [0, 1]
                }
            },
            series : [
                {
                    name: '访问来源',
                    type: 'pie',
                    radius: '55%',
                    data:[
                        {value:1, name:'搜索引擎'},
                        {value:2, name:'直接访问'},
                        {value:3, name:'邮件营销'},
                        {value:4, name:'联盟广告'},
                        {value:5, name:'视频广告'}
                    ],
                    roseType: 'angle',
                    label: {
                        normal: {
                            textStyle: {
                                color: 'rgba(255, 255, 255, 0.3)'
                            }
                        }
                    },

                    labelLine: {
                        normal: {
                            lineStyle: {
                                color: 'rgba(255, 255, 255, 0.3)'
                            }
                        }
                    },

                    itemStyle: {
                        normal: {
                            color: '#c23531',
                            shadowBlur: 200,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }

                }
            ]
        });

            draggable.init(
                $('div[_echarts_instance_]')[0],
                myChart0,
                {
                    width: 700,
                    height: 630,
                    lockY: true,
                    throttle: 70
                }
            );

            myChart0.hideLoading();

            var categoryData = [
                '北京','天津','河北','山西','内蒙古','辽宁','吉林','黑龙江',
                '上海','江苏','浙江','安徽','福建','江西','山东','河南',
                '湖北','湖南','广东','广西','海南','重庆','四川','贵州',
                '云南','西藏','陕西','甘肃','青海','宁夏','新疆'
            ];


            option = {
                baseOption: {
                    timeline: {
                        axisType: 'category',
                        autoPlay: true,
                        playInterval: 1000,
                        data: [
                            '2002-01-01', '2003-01-01', '2004-01-01',
                            '2005-01-01', '2006-01-01', '2007-01-01',
                            '2008-01-01', '2009-01-01', '2010-01-01',
                            '2011-01-01'
                        ],
                        label: {
                            formatter : function(s) {
                                return (new Date(s)).getFullYear();
                            }
                        }
                    },
                    title: {
                        subtext: 'Media Query 示例'
                    },
                    tooltip: {
                        trigger:'axis',
                        axisPointer: {
                            type: 'shadow'
                        }
                    },
                    xAxis: {
                        type: 'value',
                        name: 'GDP（亿元）',
                        max: 30000,
                        data: null
                    },
                    yAxis: {
                        type: 'category',
                        data: categoryData,
                        axisLabel: {interval: 0},
                        splitLine: {show: false}
                    },
                    legend: {
                        data: ['第一产业', '第二产业', '第三产业', 'GDP', '金融', '房地产'],
                        selected: {
                            'GDP': false, '金融': false, '房地产': false
                        }
                    },
                    calculable : true,
                    series: [
                        {name: 'GDP', type: 'bar'},
                        {name: '金融', type: 'bar'},
                        {name: '房地产', type: 'bar'},
                        {name: '第一产业', type: 'bar'},
                        {name: '第二产业', type: 'bar'},
                        {name: '第三产业', type: 'bar'},
                        {name: 'GDP占比', type: 'pie'}
                    ]
                },
                media: [
                    {
                        option: {
                            legend: {
                                orient: 'horizontal',
                                left: 'right',
                                itemGap: 10
                            },
                            grid: {
                                left: '10%',
                                top: 80,
                                right: 90,
                                bottom: 100
                            },
                            xAxis: {
                                nameLocation: 'end',
                                nameGap: 10,
                                splitNumber: 5,
                                splitLine: {
                                    show: true
                                }
                            },
                            timeline: {
                                orient: 'horizontal',
                                inverse: false,
                                left: '20%',
                                right: '20%',
                                bottom: 10,
                                height: 40
                            },
                            series: [
                                {name: 'GDP占比', center: ['75%', '30%'], radius: '28%'}
                            ]
                        }
                    },
                    {
                        query: {maxWidth: 670, minWidth: 550},
                        option: {
                            legend: {
                                orient: 'horizontal',
                                left: 200,
                                itemGap: 5
                            },
                            grid: {
                                left: '10%',
                                top: 80,
                                right: 90,
                                bottom: 100
                            },
                            xAxis: {
                                nameLocation: 'end',
                                nameGap: 10,
                                splitNumber: 5,
                                splitLine: {
                                    show: true
                                }
                            },
                            timeline: {
                                orient: 'horizontal',
                                inverse: false,
                                left: '20%',
                                right: '20%',
                                bottom: 10,
                                height: 40
                            },
                            series: [
                                {name: 'GDP占比', center: ['75%', '30%'], radius: '28%'}
                            ]
                        }
                    },
                    {
                        query: {maxWidth: 550},
                        option: {
                            legend: {
                                orient: 'vertical',
                                left: 'right',
                                itemGap: 5
                            },
                            grid: {
                                left: 55,
                                top: '32%',
                                right: 100,
                                bottom: 50
                            },
                            xAxis: {
                                nameLocation: 'middle',
                                nameGap: 25,
                                splitNumber: 3
                            },
                            timeline: {
                                orient: 'vertical',
                                inverse: true,
                                right: 10,
                                top: 150,
                                bottom: 10,
                                width: 55
                            },
                            series: [
                                {name: 'GDP占比', center: ['45%', '20%'], radius: '28%'}
                            ]
                        }
                    }
                ],
                options: [
                    {
                        title: {text: '2002全国宏观经济指标'},
                        series: [
                            {data: dataMap.dataGDP['2002']},
                            {data: dataMap.dataFinancial['2002']},
                            {data: dataMap.dataEstate['2002']},
                            {data: dataMap.dataPI['2002']},
                            {data: dataMap.dataSI['2002']},
                            {data: dataMap.dataTI['2002']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2002sum']},
                                {name: '第二产业', value: dataMap.dataSI['2002sum']},
                                {name: '第三产业', value: dataMap.dataTI['2002sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2003全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2003']},
                            {data: dataMap.dataFinancial['2003']},
                            {data: dataMap.dataEstate['2003']},
                            {data: dataMap.dataPI['2003']},
                            {data: dataMap.dataSI['2003']},
                            {data: dataMap.dataTI['2003']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2003sum']},
                                {name: '第二产业', value: dataMap.dataSI['2003sum']},
                                {name: '第三产业', value: dataMap.dataTI['2003sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2004全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2004']},
                            {data: dataMap.dataFinancial['2004']},
                            {data: dataMap.dataEstate['2004']},
                            {data: dataMap.dataPI['2004']},
                            {data: dataMap.dataSI['2004']},
                            {data: dataMap.dataTI['2004']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2004sum']},
                                {name: '第二产业', value: dataMap.dataSI['2004sum']},
                                {name: '第三产业', value: dataMap.dataTI['2004sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2005全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2005']},
                            {data: dataMap.dataFinancial['2005']},
                            {data: dataMap.dataEstate['2005']},
                            {data: dataMap.dataPI['2005']},
                            {data: dataMap.dataSI['2005']},
                            {data: dataMap.dataTI['2005']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2005sum']},
                                {name: '第二产业', value: dataMap.dataSI['2005sum']},
                                {name: '第三产业', value: dataMap.dataTI['2005sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2006全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2006']},
                            {data: dataMap.dataFinancial['2006']},
                            {data: dataMap.dataEstate['2006']},
                            {data: dataMap.dataPI['2006']},
                            {data: dataMap.dataSI['2006']},
                            {data: dataMap.dataTI['2006']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2006sum']},
                                {name: '第二产业', value: dataMap.dataSI['2006sum']},
                                {name: '第三产业', value: dataMap.dataTI['2006sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2007全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2007']},
                            {data: dataMap.dataFinancial['2007']},
                            {data: dataMap.dataEstate['2007']},
                            {data: dataMap.dataPI['2007']},
                            {data: dataMap.dataSI['2007']},
                            {data: dataMap.dataTI['2007']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2007sum']},
                                {name: '第二产业', value: dataMap.dataSI['2007sum']},
                                {name: '第三产业', value: dataMap.dataTI['2007sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2008全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2008']},
                            {data: dataMap.dataFinancial['2008']},
                            {data: dataMap.dataEstate['2008']},
                            {data: dataMap.dataPI['2008']},
                            {data: dataMap.dataSI['2008']},
                            {data: dataMap.dataTI['2008']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2008sum']},
                                {name: '第二产业', value: dataMap.dataSI['2008sum']},
                                {name: '第三产业', value: dataMap.dataTI['2008sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2009全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2009']},
                            {data: dataMap.dataFinancial['2009']},
                            {data: dataMap.dataEstate['2009']},
                            {data: dataMap.dataPI['2009']},
                            {data: dataMap.dataSI['2009']},
                            {data: dataMap.dataTI['2009']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2009sum']},
                                {name: '第二产业', value: dataMap.dataSI['2009sum']},
                                {name: '第三产业', value: dataMap.dataTI['2009sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2010全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2010']},
                            {data: dataMap.dataFinancial['2010']},
                            {data: dataMap.dataEstate['2010']},
                            {data: dataMap.dataPI['2010']},
                            {data: dataMap.dataSI['2010']},
                            {data: dataMap.dataTI['2010']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2010sum']},
                                {name: '第二产业', value: dataMap.dataSI['2010sum']},
                                {name: '第三产业', value: dataMap.dataTI['2010sum']}
                            ]}
                        ]
                    },
                    {
                        title : {text: '2011全国宏观经济指标'},
                        series : [
                            {data: dataMap.dataGDP['2011']},
                            {data: dataMap.dataFinancial['2011']},
                            {data: dataMap.dataEstate['2011']},
                            {data: dataMap.dataPI['2011']},
                            {data: dataMap.dataSI['2011']},
                            {data: dataMap.dataTI['2011']},
                            {data: [
                                {name: '第一产业', value: dataMap.dataPI['2011sum']},
                                {name: '第二产业', value: dataMap.dataSI['2011sum']},
                                {name: '第三产业', value: dataMap.dataTI['2011sum']}
                            ]}
                        ]
                    }
                ]
            };

            myChart0.setOption(option);

 </script>-->






<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
