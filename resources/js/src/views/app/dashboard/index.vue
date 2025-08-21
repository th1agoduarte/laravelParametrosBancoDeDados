<template>
    <ContentLayout :title="name" :descriptionCurrentPage="name" :linksBreadcrumb="[]">
  
                  <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                      <div class="widget widget-dailysales">
                          <div class="widget-heading">
                              <div>
                                  <h5>Daily Automations</h5>
                                  <span class="sub-title">Go to Columns for more details.</span>
                              </div>
                          </div>
                          <div class="widget-content">
                              <apex-chart
                                  v-if="exec_trigger_options"
                                  height="300"
                                  type="bar"
                                  :options="exec_trigger_options"
                                  :series="dayByDayWeek()">
                              </apex-chart>
                          </div>
                      </div>
                  </div>
  
                  <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                      <div class="widget widget-summary">
                          <div class="widget-heading">
                              <h5>Summary of Automations Month</h5>
                          </div>
                          <div class="widget-content" style="overflow: auto;height: 356px;">
                              <SummaryList v-for="item in props.sumary" :key="item.id" :item="item"
                                  :title="item.name"
                                  :count="item.triggers.length"
                                  :progress="percProgress(item.triggers.length)"
                                  :icon="selectIcon(item.name)"
                                   />
                          </div>
                      </div>
                  </div>
  
                  <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                      <div class="widget widget-recent-activity">
                          <div class="widget-heading">
                              <h5>Recent Activities</h5>
                          </div>
                          <div class="widget-content">
                              <perfect-scrollbar class="timeline-line">
                                  <RecentActivity v-for="item in props.recentActivities.data" :key="item.id" :item="item"
                                      :description="item.description"
                                      :status="item.status"
                                      :time="item.updated_at_formatted"
                                  />
                              </perfect-scrollbar>
  
                          </div>
                      </div>
                  </div>
  
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                      <div class="widget widget-dailysales">
                          <div class="widget-heading row col-xl-12">
                              <div class="col-xl-8">
                                  <h5>Processed Items {{data.graphics_process_title}}</h5>
                                  <!-- <span class="sub-title">Vá para as Colunas para mais Detalhes.</span> -->
                              </div>
                              <div class="col-xl-4" align="right">
                                  <button v-if="true" class="btn btn-dark" @click="changeGraphicsType('Bar')">
                                    Bar Graph
                                  </button>
                                  &nbsp;
                                  <button v-if="true" class="btn btn-primary" @click="changeGraphicsType('Pie')">
                                    Pie chart
                                  </button>
                              </div>
                          </div>
                          <div class="widget-content">
                            <div id="loading" style="
                                margin-right: 49%;
                                display: none;
                                width: 50px;
                                height: 50px;
                                border: 3px solid rgb(67 97 238 / 55%);
                                margin-top: 152px;
                                float: right;
                                border-radius: 50%;
                                border-top-color: #fff;
                                animation: spin 1s ease-in-out infinite;
                                -webkit-animation: spin 1s ease-in-out infinite;
                            "></div>
                              <div style="min-height: 350px;">
                                  <apex-chart 
                                      v-if="automations_process_pie_options && data.graphics_process == 'day' && data.graphics_type == 'Pie'"
                                      type="pie" 
                                      style="width: 100%;"
                                      height="350" 
                                      :options="automations_process_pie_options" 
                                      :series="processAutomationsPieThisDay()">
                                  </apex-chart>
                                  <apex-chart 
                                      v-if="automations_process_pie_options && data.graphics_process == 'month' && data.graphics_type == 'Pie'"
                                      type="pie" 
                                      style="width: 100%;"
                                      height="350" 
                                      :options="automations_process_pie_options" 
                                      :series="processAutomationsPieThisWeek()">
                                  </apex-chart>
                                  <apex-chart 
                                      v-if="automations_process_pie_options && data.graphics_process == 'week' && data.graphics_type == 'Pie'"
                                      type="pie" 
                                      style="width: 100%;"
                                      height="350" 
                                      :options="automations_process_pie_options" 
                                      :series="processAutomationsPieThisMonth()">
                                  </apex-chart>
                                  <apex-chart 
                                      v-if="automations_process_pie_options && data.graphics_process == 'year' && data.graphics_type == 'Pie'"
                                      type="pie" 
                                      style="width: 100%;"
                                      height="350" 
                                      :options="automations_process_pie_options" 
                                      :series="processAutomationsPieThisYear()">
                                  </apex-chart>
  
                                  <apex-chart
                                      v-if="automations_process_bar_options && data.graphics_process == 'day' && data.graphics_type == 'Bar'"
                                      height="350"
                                      type="bar"
                                      :options="automations_process_bar_options"
                                      :series="processAutomationsBarThisDay()">
                                  </apex-chart>
                                  <apex-chart
                                      v-if="automations_process_bar_options && data.graphics_process == 'week' && data.graphics_type == 'Bar'"
                                      height="350"
                                      type="bar"
                                      :options="automations_process_bar_options"
                                      :series="processAutomationsBarThisWeek()">
                                  </apex-chart>
                                  <apex-chart
                                      v-if="automations_process_bar_options && data.graphics_process == 'month' && data.graphics_type == 'Bar'"
                                      height="350"
                                      type="bar"
                                      :options="automations_process_bar_options"
                                      :series="processAutomationsBarThisMonth()">
                                  </apex-chart>
                                  <apex-chart
                                      v-if="automations_process_bar_options && data.graphics_process == 'year' && data.graphics_type == 'Bar'"
                                      height="350"
                                      type="bar"
                                      :options="automations_process_bar_options"
                                      :series="processAutomationsBarThisYear()">
                                  </apex-chart>
                              </div>
                             
                              <br>
                              <br>
                              <br>
                              <div class="row col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                                  
                                  <div class="col-xl-3" align="center">
                                      <button v-if="true" class="btn btn-primary col-6" @click="changeGraphicsTickets('day')">
                                        Today
                                          </button>
                                  </div>
                                  
                                  <div class="col-xl-3" align="center">
                                      <button v-if="true" class="btn btn-primary col-6" @click="switchPeriodGraphics('week')">
                                        Week
                                          </button>
                                  </div>
                                  
                                  <div class="col-xl-3" align="center">
                                      <button v-if="true" class="btn btn-primary col-6" @click="switchPeriodGraphics('month')">
                                        Month
                                          </button>
                                  </div>
                                  
                                  <div class="col-xl-3" align="center">
                                      <button v-if="true" class="btn btn-primary col-6" @click="switchPeriodGraphics('year')">
                                        Year
                                          </button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
  
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                      <div class="widget widget-recent-orders">
                          <div class="widget-heading">
                              <h5>Today's Appointments</h5>
                          </div>
                          <div class="widget-content table-responsive">
                              <TableSchedule :automationsList="automationsList" :dataReport="schedulesData.schedulesReports" />
                          </div>
                      </div>
                  </div>
  
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                      <div class="widget widget-recent-orders">
                          <div class="widget-heading">
                              <h5>Recent Automations</h5>
                          </div>
                          <div class="widget-content table-responsive">
                              <TableActions :dataActions="props.recentActions" />
                          </div>
                      </div>
                  </div>
    </ContentLayout>
  </template>
  <script setup>
  import { Inertia } from "@inertiajs/inertia";
  import { computed, ref,reactive,onMounted } from 'vue';
  import { useStore } from 'vuex';
  import { useMeta } from "@/composables/use-meta";
  
  import ContentLayout from "@/layouts/content-layout.vue";
  import SummaryList from "./partials/summary-list.vue";
  import RecentActivity from "./partials/recent-activity.vue";
  import TableActions from "@/components/common/table-actions.vue";
  import TableSchedule from "@/views/app/automations/schedules/partials/table-results.vue";
  import ApexChart from 'vue3-apexcharts';
  
  const name = "Dashboard";
  useMeta({ title: name });
  onMounted(() => {
      if(props.schedulesReports){
          schedulesData.schedulesReports = props.schedulesReports;
      }
  });
  const store = useStore();
  const props = defineProps({
      sumary: { type: Object, require: false },
      dayByDayCurrentWeek: { type: Object, require: false },
      dayByDayLastWeek: { type: Object, require: false },
      getProcessAutomationsThisWeek: { type: Object, require: false },
      getProcessAutomationsThisDay: { type: Object, require: false },
      getProcessAutomationsThisMonth: { type: Object, require: false },
      getProcessAutomationsThisYear: { type: Object, require: false },
      recentActivities: { type: Object, require: false },
      recentActions: { type: Object, require: false },
      automationNames: { type: Object, require: false },
      schedulesReports: { type: Object, require: false ,default: null},
      automationsList: { type: Object, require: false },
  });
  const schedulesData =reactive({
      schedulesReports:{data:[]}
  });
  
  const totalTriggers =()=>{
      let sum =0;
      Object.entries(props.sumary).forEach(
              ([key, item]) => {
                  sum += item.triggers.length;
              }
          );
      return sum;
  }
  const data = reactive({
      exec_trigger_series:[
          {name: 'Executions', data:[0,0,0,0,0,0,0]},
          { name: 'Last week', data:[0,0,0,0,0,0,0] }
      ],
      process_automation_pie_series:[0,0,0,0,0,0,0,0,0],
      process_automation_bar_series:[
          {name: 'Itens Processados', data:[0,0,0,0,0,0,0,0,0]},
      ],
      graphics_process: 'day',
      graphics_process_title: 'Today',
      graphics_type: 'Bar', 
      week_load:false,
      month_load:false,
      year_load:false,
  });
  
  const dayByDayWeek = ()=>{
      Object.entries(props.dayByDayLastWeek).forEach(
              ([key, item]) => {
                  data.exec_trigger_series[1].data[item.dayWeek-1] = item.count;
              }
          );
      Object.entries(props.dayByDayCurrentWeek).forEach(
              ([key, item]) => {
                  data.exec_trigger_series[0].data[item.dayWeek-1] = item.count;
              }
          );
          return data.exec_trigger_series;
  }
  
  const percProgress = (valor) => valor>0? (valor/totalTriggers())*100:0;
  const selectIcon = (name) => {
      switch (name) {
          case '':
              return 'car';
          default:
              return 'car';
      }
  
  }
  
  const exec_trigger_options = computed(() => {
      return {
          chart: {type: 'bar', toolbar: { show: false }, stacked: true, /* stackType: '100%' */ },
          /* dataLabels: { enabled: false }, */
          /* stroke: { show: true, width: 1 }, */
          /* colors: ['#e2a03f', '#e0e6ed'], */
          responsive: [{ breakpoint: 480, options: { legend: { position: 'bottom', offsetX: -10, offsetY: 0 } } }],
          xaxis: { labels: { show: true }, categories: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] },
          yaxis: { show: false },
          fill: { opacity: 1 },
          plotOptions: { bar: { horizontal: false, columnWidth: '40%' } },
          legend: { position: 'right',
              offsetY: 40 },
          grid: {
              show: false,
              xaxis: { lines: { show: false } },
              padding: { top: 10, right: -20, bottom: 0, left: -10 },
          },
      };
  });
  
  const automations_process_bar_options = computed(() => {
      return {
          chart: {
              type: 'bar',height: 350,toolbar: { show: false }
          },
          plotOptions: {
            bar: {borderRadius: 4,barHeight: '100%',horizontal: true,columnWidth: '100%',dataLabels: {position: 'bottom'}}
          },
          dataLabels: {
              enabled: true,textAnchor: 'start',style: {colors: ['#46474c']},formatter: function (val, opt) {return val},offsetX: 0,dropShadow: {enabled: false}
          },
          xaxis: {
            labels: {show: false},categories: props.automationNames
          },
          yaxis: {
              labels: {
                  show: true,
                  maxWidth: 500,
              },
          },
      }
  });
  const automations_process_pie_options = computed(() => {
      return {
          chart: {
            width: 380,
            type: 'pie',
          },
          colors:['#008ffb', '#9C27B0', '#6bc500', '#00e396', '#feb019','#4130db', '#ff4560', '#ff45eb', '#775dd0', '#34788a', '#E91E63', '#fd53f2',   ],
          labels: props.automationNames,
          dataLabels:{
              enabled: true,
              formatter: function (val, opt) { return opt.w.globals.series[opt.seriesIndex]}
          },
          responsive: [{
            breakpoint: 480,
            options: {
              chart: {
                width: 200
              },
              legend: {
                position: 'bottom'
              }
            }
          }]
      }
  });
  
  const processAutomationsPieThisDay = ()=>{
    Object.entries(props.getProcessAutomationsThisDay).forEach(
            ([key, item]) => {
                data.process_automation_pie_series[key] = item;
            }
        );
      return data.process_automation_pie_series;
  }
  
  const processAutomationsPieThisWeek = ()=>{
      return data.process_automation_pie_series;
  }
  
  const processAutomationsPieThisMonth = ()=>{
      return data.process_automation_pie_series;
  }
  
  const processAutomationsPieThisYear = ()=>{
      return data.process_automation_pie_series;
  }
  
  const changeGraphicsTickets = (graphic)=>{
      data.graphics_process = graphic;
      switch(graphic){
          case 'day':
              data.graphics_process_title = 'Today'
          break;
          case 'week':
              data.graphics_process_title = 'In the week'
              data.week_load = true;
          break;
          case 'month':
              data.graphics_process_title = 'In the month'
              data.month_load = true;
          break;
          case 'year':
              data.graphics_process_title = 'In the year'
              data.year_load = true;
          break;
      }
  }
  
  const processAutomationsBarThisDay = ()=>{
      Object.entries(props.getProcessAutomationsThisDay).forEach(
              ([key, item]) => {
                  data.process_automation_bar_series[0].data[key] = item;
              }
          );
      return data.process_automation_bar_series;
  }
  
  const processAutomationsBarThisWeek = ()=>{
      return data.process_automation_bar_series;
  }
  
  const processAutomationsBarThisMonth = ()=>{
      return data.process_automation_bar_series;
  }
  
  const processAutomationsBarThisYear = ()=>{
      return data.process_automation_bar_series;
  }
  
  const changeGraphicsType = (graphic)=>{
      data.graphics_type = graphic;
  }
  
  const switchPeriodGraphics = (graphic) => {
  data.graphics_process = '';
  document.getElementById('loading').style.display = 'block'
      fetch('/app/data-graphics?period='+graphic).then(response =>{
          return response.json();
      }).then(fetch =>
      {
          Object.entries(fetch.data).forEach(
              ([key, item]) => {
                  data.process_automation_bar_series[0].data[key] = item;
                  data.process_automation_pie_series[key] = item;
              }
          );
          changeGraphicsTickets(graphic);
            document.getElementById('loading').style.display = 'none'
      })
      
  }
  </script>
  