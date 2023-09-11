
@can('read airport')
<li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-components">Airport</span></li>

<li class="nav-item">
    <a class="nav-link menu-link" href="#sidebarUI" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUI">
        <i class="ri-bell-line"></i><span data-key="t-base-ui">Receive Dispatch</span>
    </a>
    <div class="collapse menu-dropdown mega-dropdown-menu" id="sidebarUI">
        <div class="row">
            <div class="col-lg-4">
                <ul class="nav nav-sm flex-column">

                    <li class="nav-item">
                        <a href="{{ route('admin.inbox.AirportDispach') }}" class="nav-link" data-key="t-alerts">Dispatch List </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.inbox.DispatchTransfered') }}" class="nav-link" data-key="t-badges">Dispatch Transfered</a>
                    </li>

                    <li class="nav-item">
                      <a href="{{ route('admin.inbox.Mailarrived') }}" class="nav-link" data-key="t-badges">Dispatch  Arrived</a>
                  </li>

                </ul>
            </div>

            @endcan
            @can('read airport')


<li class="nav-item">
    <a class="nav-link menu-link" href="#sidebarU" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUI">
        <i class="ri-pencil-ruler-2-line"></i> <span data-key="t-base-ui">Dispatch Report</span>
    </a>
    <div class="collapse menu-dropdown mega-dropdown-menu" id="sidebarU">
        <div class="row">
            <div class="col-lg-4">
                <ul class="nav nav-sm flex-column">

                    <li class="nav-item">
                        <a href="{{ route('admin.inbox.AirportDispachrepd') }}" class="nav-link" data-key="t-alerts">Daily Report</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.inbox.AirportDispachrep') }}" class="nav-link" data-key="t-badges">Monthly Report</a>
                    </li>

                </ul>
            </div>
            @endcan
            @can('read incoming mail')
            <li class="nav-item">
              <a class="nav-link menu-link" href="#sidebarTables" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTables">
                <i class="ri-file-word-line"></i> <span data-key="t-tables">Dispatch Inboxing</span>
              </a>
              <div class="collapse menu-dropdown" id="sidebarTables">
                  <ul class="nav nav-sm flex-column">

                      <li class="nav-item">
                          <a href="{{ route('admin.cntp.CntpDispach') }}" class="nav-link" data-key="t-basic-tables">Dispacher Recieving</a>
                      </li>
                      @if (auth()->user()->level === 'cntp' && auth()->user()->cntpoffice == null)
                      <li class="nav-item">
                          <a href="{{ route('admin.cntp.CntpMailOpening') }}" class="nav-link" data-key="t-grid-js">Dispacher Opening</a>
                      </li>
                      @endif
                      @if (auth()->user()->cntpoffice=='emscntp')
                      <li class="nav-item">
                        <a href="{{ route('admin.cntp.CntpemsOpening') }}" class="nav-link" data-key="t-grid-js">Dispacher Opening</a>
                    </li>
                    @endif
                    @if (auth()->user()->cntpoffice=='perceloffice')
                    <li class="nav-item">
                        <a href="{{ route('admin.cntp.CntppercelOpening') }}" class="nav-link" data-key="t-grid-js">Dispacher Opening</a>
                    </li>
                    @endif
                    @if (auth()->user()->cntpoffice=='boxoffice')
                    <li class="nav-item">
                        <a href="{{ route('admin.cntp.CntpregOpening') }}" class="nav-link" data-key="t-grid-js">Dispacher Opening</a>
                    </li>
                  @endif
                  @if (auth()->user()->cntpoffice=='emscntp')
                  <li class="nav-item">
                      <a href="{{ route('admin.cntpsort.CntpEmssorting') }}" class="nav-link" data-key="t-grid-js">Dispacher Sorting</a>
                  </li>
                @endif
                @if (auth()->user()->cntpoffice=='perceloffice')
                <li class="nav-item">
                    <a href="{{ route('admin.cntpsort.Cntppercelsorting') }}" class="nav-link" data-key="t-grid-js">Dispacher Sorting</a>
                </li>
              @endif
              @if (auth()->user()->cntpoffice=='boxoffice')
              <li class="nav-item">
                  <a href="{{ route('admin.cntpsort.Cntpregisteredsorting') }}" class="nav-link" data-key="t-grid-js">Dispacher Sorting</a>
              </li>
            @endif
            @if (auth()->user()->level === 'cntp' && auth()->user()->cntpoffice == null)
            <li class="nav-item">
                <a href="{{ route('admin.cntpsort.Cntpallmailssorting') }}" class="nav-link" data-key="t-grid-js">Dispacher Sorting</a>
            </li>
          @endif

                  </ul>
              </div>
          </li>
         @endcan

         @can('read incoming mail')
         <li class="nav-item">
             <a class="nav-link menu-link" href="#sidebarIcons" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarIcons">
                 <i class="ri-compasses-2-line"></i> <span data-key="t-icons">Mail Registration</span>
             </a>
             <div class="collapse menu-dropdown" id="sidebarIcons">
                 <ul class="nav nav-sm flex-column">
                    @if (auth()->user()->level === 'cntp' && auth()->user()->cntpoffice == null)
                     <li class="nav-item">
                         <a href="{{ route('admin.mails.OrdinaryMail') }}" class="nav-link" data-key="t-remix">Ordinary Mail</a>
                     </li>

                     <li class="nav-item">
                         <a href="{{ route('admin.transfero.OrdinaryMailTransfer') }}" class="nav-link" data-key="t-remix">Ordinary Mail Transfer</a>
                     </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.mailsprinted.PrintedMaterial') }}" class="nav-link" data-key="t-remix">Printed Material</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.transferprinted.PrintedMaterialTransfer') }}" class="nav-link" data-key="t-remix">Printed Material Transfer</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.mailsjurnal.Jurnal') }}" class="nav-link" data-key="t-remix">Jurnal</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.transferjurnal.JurnalTransfer') }}" class="nav-link" data-key="t-remix">Jurnal Transfer</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.mailsgooglead.Googlead') }}" class="nav-link" data-key="t-remix">Google Adjacent</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.transfergooglead.GoogleadTransfer') }}" class="nav-link" data-key="t-remix">Google Adjacent Transfer</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.mailspostcard.PostCard') }}" class="nav-link" data-key="t-remix">Post Card</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.transferpostcard.PostCardTransfer') }}" class="nav-link" data-key="t-remix">Post Card Transfer</a>
                    </li>
                     @endif

                     @if (auth()->user()->cntpoffice=='boxoffice')
                     <li class="nav-item">
                         <a href="{{ route('admin.mailsr.RegisteredMail') }}" class="nav-link" data-key="t-boxicons">Registered Mail</a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('admin.transferr.RegisteredMailTransfer') }}" class="nav-link" data-key="t-boxicons">Registered Mail Transfer</a>
                     </li>
                     @endif
                     @if (auth()->user()->cntpoffice=='perceloffice')
                     <li class="nav-item">
                         <a href="{{ route('admin.mailsp.PercelMail') }}" class="nav-link"> <span data-key="t-crypto-svg">Percel MAIL</span></a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('admin.transferp.PercelMailTransfer') }}" class="nav-link"> <span data-key="t-crypto-svg">Perce Mail Transfer</span></a>
                     </li>
                     @endif
                     @if (auth()->user()->cntpoffice=='emscntp')
                     <li class="nav-item">
                         <a href="{{ route('admin.mailsem.EmsMail') }}" class="nav-link"> <span data-key="t-crypto-svg">EMS MAIL</span></a>
                     </li>
                     <li class="nav-item">
                         <a href="{{ route('admin.transferem.EmsMailTransfer') }}" class="nav-link"> <span data-key="t-crypto-svg">EMS MAIL Transfer</span></a>
                     </li>
                     @endif




                 </ul>
             </div>
         </li>
         @endcan
         @can('read incoming mail')
         <li class="nav-item">
             <a class="nav-link menu-link" href="#sidebarIconss" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarIcons">
                 <i class="ri-mail-line"></i> <span data-key="t-icons">Letter Registration</span>
             </a>
             <div class="collapse menu-dropdown" id="sidebarIconss">
                 <ul class="nav nav-sm flex-column">

                    @if (auth()->user()->level === 'cntp' && auth()->user()->cntpoffice == null)
                     <li class="nav-item">
                         <a href="{{ route('admin.mailsrl.RegisteredLetter') }}" class="nav-link"> <span data-key="t-crypto-svg">Registered Letter</span></a>
                     </li>
                     <li class="nav-item">
                        <a href="{{ route('admin.transferrl.RegisteredLetterTransfer') }}" class="nav-link"> <span data-key="t-crypto-svg">Registered Letter Transfer</span></a>
                    </li>
                     <li class="nav-item">
                         <a href="{{ route('admin.mailsol.OrdinaryLetter') }}" class="nav-link"> <span data-key="t-crypto-svg">Ordinary Letter</span></a>
                     </li>

                     <li class="nav-item">
                         <a href="{{ route('admin.transferol.OrdinaryLetterTransfer') }}" class="nav-link"> <span data-key="t-crypto-svg">Ordinary Letter Transfer</span></a>
                     </li>

                     @endif


                 </ul>
             </div>
         </li>
         @endcan

         @can('read incoming mail')
         <li class="nav-item">
           <a class="nav-link menu-link" href="#ctnptoutboxing" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTables">
               <i class="ri-layout-grid-line"></i> <span data-key="t-tables">Dispatch Outboxing</span>
           </a>
           <div class="collapse menu-dropdown" id="ctnptoutboxing">
               <ul class="nav nav-sm flex-column">

                   <li class="nav-item">
                       <a href="{{ route('admin.outtems.outboxingems') }}" class="nav-link" data-key="t-basic-tables">EMS Receiving</a>
                   </li>
                   <li class="nav-item">
                       <a href="{{ route('admin.outtregis.outboxingregistered') }}" class="nav-link" data-key="t-grid-js">Registered Receiving</a>
                   </li>

                   <li class="nav-item">
                      <a href="{{ route('admin.outtperc.outboxingpercel') }}" class="nav-link" data-key="t-grid-js">Percel Receiving</a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.outttem.outboxingtemble') }}" class="nav-link" data-key="t-grid-js">Posting With Temble</a>
                  </li>
               </ul>
           </div>
       </li>

       <li class="nav-item">
        <a class="nav-link menu-link" href="#ctnptoutboxingreport" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTables">
            <i class="ri-cloudy-line"></i> <span data-key="t-tables">Dispatch Report</span>
        </a>
        <div class="collapse menu-dropdown" id="ctnptoutboxingreport">
            <ul class="nav nav-sm flex-column">

                <li class="nav-item">
                    <a href="{{ route('admin.cntp.reportDispachDaily') }}" class="nav-link" data-key="t-basic-tables">Daily Opening</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.cntp.reportDispatchmonthly') }}" class="nav-link" data-key="t-grid-js">Monthly Opening</a>
                </li>
                <li class="nav-item ">
                    <a href="#employees" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="employees" data-key="t-candidate-lists">
                        Dispatch Outboxing
                    </a>
                    <div class="collapse menu-dropdown " id="employees">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.outtems.reportoutboxingems') }}" class="nav-link" data-key="t-all">EMS
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.outtregis.detailsregistered') }}" class="nav-link " data-key="t-active">Registered Small Packet
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.outtperc.perceloutboxingregise') }}" class="nav-link" data-key="t-inactive">Percel
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.outttem.tembleoutboxingrep') }}" class="nav-link" data-key="t-deactiveted">Post With Temble
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.combined.index') }}" class="nav-link" data-key="t-starter">Packing Outboxing</a>
                </li>


            </ul>
        </div>
    </li>

      @endcan


{{-- start branch manager activity --}}
@can( 'Read Dispach Recieving')
<li class="nav-item">
    <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLanding">
        <i class="ri-rocket-line"></i> <span data-key="t-landing">Mail Inboxing</span>
    </a>
    <div class="collapse menu-dropdown" id="sidebarLanding">
        <ul class="nav nav-sm flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.dreceive.Depechereceive') }}" class="nav-link" data-key="t-one-page">Dispach Receiving</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.mrcsn.Mailcheckingandnotification') }}" class="nav-link" data-key="t-nft-landing">Mail RCSN</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.list.search') }}" class="nav-link" data-key="t-nft-landing">Mail List</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.pay.Omailpay') }}" class="nav-link" data-key="t-nft-landing">Ordinary Pay</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.payr.Rmailpay') }}" class="nav-link" data-key="t-nft-landing">Registered Pay</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.payp.Pmailpay') }}" class="nav-link" data-key="t-nft-landing">Percel Pay</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.emspay.emspays') }}" class="nav-link" data-key="t-nft-landing">EMS Pay</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.payg.Googlepay') }}" class="nav-link" data-key="t-nft-landing">Google Ad Pay</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.mailde.Maildelevery') }}" class="nav-link" data-key="t-nft-landing">Mail Delivery</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.bstore.storing') }}" class="nav-link" data-key="t-nft-landing">Branch Store</a>
            </li>
        </ul>
    </div>
</li>
@endcan

          {{--  <li class="nav-item">
              <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                  <i class="ri-rocket-line"></i> <span data-key="t-landing">Income Registration</span>
              </a>
              <div class="collapse menu-dropdown" id="sidebarLanding">
                  <ul class="nav nav-sm flex-column">
                      <li class="nav-item">
                          <a href="{{ route('admin.income.Oincames') }}" class="nav-link" data-key="t-one-page">Ordinary Incomes</a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.incomer.Rincames') }}" class="nav-link" data-key="t-nft-landing">Registered Incomes</a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.incomep.Pincames') }}" class="nav-link" data-key="t-nft-landing">Percel Incomes</a>
                      </li>
                  </ul>
              </div>
          </li>
          @endcan
        --}}

        @can ('read outboxing')
        <li class="nav-item">
            <a class="nav-link menu-link" href="#outboxingmanagement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="outboxingmanagement">
                <i class="ri-pages-line"></i> <span data-key="t-pages">Mail Outboxing</span>
            </a>
            <div class="collapse menu-dropdown" id="outboxingmanagement">
                <ul class="nav nav-sm flex-column">
                    @can ('make outboxing')
                    <li class="nav-item">
                        <a href="{{ route('branch.outboxing.index') }}" class="nav-link" data-key="t-starter">EMS</a>
                    </li>
                    @endcan

                    @can ('make outboxing')
                    <li class="nav-item">
                        <a href="{{ route('branch.registeredoutboxing.index') }}" class="nav-link" data-key="t-starter">Registered & Small Packet </a>
                    </li>
                    @endcan
                    @can ('make outboxing')
                    <li class="nav-item">
                        <a href="{{ route('branch.perceloutboxing.index') }}" class="nav-link" data-key="t-starter">Percel </a>
                    </li>
                    @endcan
                    @can ('make outboxing')
                    <li class="nav-item">
                        <a href="{{ route('branch.tembleoutboxing.index') }}" class="nav-link" data-key="t-starter">Posting With Temble</a>
                    </li>
                    @endcan

                </ul>
            </div>
        </li>
        @endcan
        @can ('read outboxing')
        <li class="nav-item">
            <a class="nav-link menu-link" href="#outboxingtransfer" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="outboxingmanagement">
                <i class="ri-pages-line"></i> <span data-key="t-pages">Mail Outboxing Transfer</span>
            </a>
            <div class="collapse menu-dropdown" id="outboxingtransfer">
                <ul class="nav nav-sm flex-column">
                    @can ('make outboxing')
                    <li class="nav-item">
                        <a href="{{ route('admin.outte.index') }}" class="nav-link" data-key="t-starter">EMS </a>
                    </li>
                    @endcan
                    @can ('make outboxing')
                    <li class="nav-item">
                        <a href="{{ route('admin.outtr.index') }}" class="nav-link" data-key="t-starter">Registered Small Packet </a>
                    </li>
                    @endcan
                    @can ('make outboxing')
                    <li class="nav-item">
                        <a href="{{ route('admin.outtp.index') }}" class="nav-link" data-key="t-starter">Percel </a>
                    </li>
                    @endcan
                    @can ('make outboxing')
                    <li class="nav-item">
                        <a href="{{ route('admin.outtte.index') }}" class="nav-link" data-key="t-starter">Posting With Temble</a>
                    </li>
                    @endcan

                </ul>
            </div>
        </li>
        @endcan
        {{--  @can ('read outboxing')
        <li class="nav-item">
            <a class="nav-link menu-link" href="#mailincomehistory" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="mailincomehistory">
                <i class="ri-pages-line"></i> <span data-key="t-pages">Mail Income History</span>
            </a>
            <div class="collapse menu-dropdown" id="mailincomehistory">
                <ul class="nav nav-sm flex-column">
                    @can ('make outboxing')
                    <li class="nav-item">
                        <a href="{{ route('branch.outboxing.history') }}" class="nav-link" data-key="t-starter">EMS Mail Outboxing History</a>
                    </li>
                    @endcan
                    @can ('make outboxing')
                    <li class="nav-item">
                        <a href="{{ route('branch.registeredoutboxing.history') }}" class="nav-link" data-key="t-starter">Registered Small Packet Outboxing History</a>
                    </li>
                    @endcan
                    @can ('make outboxing')
                    <li class="nav-item">
                        <a href="{{ route('branch.perceloutboxing.history') }}" class="nav-link" data-key="t-starter">Percel Outboxing History</a>
                    </li>
                    @endcan
                    @can ('make outboxing')
                    <li class="nav-item">
                        <a href="{{ route('branch.tembleoutboxing.history') }}" class="nav-link" data-key="t-starter">Posting With Temble History</a>
                    </li>
                    @endcan

                </ul>
            </div>
        </li>
        @endcan
    --}}

    @can('branch physicalPob')
    <li class="nav-item">
        <a class="nav-link menu-link {{ in_array(Route::currentRouteName(), ['physicalPob.index', 'physicalPob.waitingList', 'physicalPob.approved','physicalPob.details','physicalPob.pobCategory']) ? 'active' : '' }}" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
            <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Physical P.O Box</span>
        </a>
        <div class="collapse menu-dropdown {{ in_array(Route::currentRouteName(), ['physicalPob.index', 'physicalPob.waitingList', 'physicalPob.approved', 'physicalPob.selling','physicalPob.details','physicalPob.dailyIncome', 'physicalPob.monthlyIncome','physicalPob.pobCategory']) ? 'show' : '' }}" id="sidebarLayouts">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a href="{{ route('physicalPob.index') }}" class="nav-link {{ Request::routeIs('physicalPob.index') ? 'active' : '' }}" data-key="t-poboxlist">P.O Box List</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('physicalPob.selling') }}" class="nav-link {{ Request::routeIs('physicalPob.selling') ? 'active' : '' }}" data-key="t-poboxSelling">P.O Box Selling</a>
                </li>
                <li class="nav-item">
                    <a href="#sidebarCandidatelists" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCandidatelists" data-key="t-candidate-lists">
                        P.O Box Application
                    </a>
                    <div class="collapse menu-dropdown {{ in_array(Route::currentRouteName(), ['physicalPob.waitingList', 'physicalPob.approved']) ? 'show' : '' }}" id="sidebarCandidatelists">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('physicalPob.approved') }}" class="nav-link {{ Request::routeIs('physicalPob.approved') ? 'active' : '' }}" data-key="t-Approved"> Approved
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('physicalPob.waitingList') }}" class="nav-link {{ Request::routeIs('physicalPob.waitingList') ? 'active' : '' }}" data-key="t-Waiting-list"> Waiting list</a>
                            </li>
                        </ul>
                    </div>
                </li>

                
                <li class="nav-item">
                    <a href="{{ route('physicalPob.index1') }}" class="nav-link {{ Request::routeIs('physicalPob.index1') ? 'active' : '' }}" data-key="t-poboxSelling">P.O Box Categories</a>
                </li>
            </ul>
        </div>
    </li>
    @endcan
    @can('branch virtualPob')
    <li class="nav-item">
        <a class="nav-link menu-link {{ in_array(Route::currentRouteName(), ['virtualPob.index', 'virtualPob.waitingList', 'virtualPob.approved','virtualPob.details']) ? 'active' : '' }}" href="#virtualPob" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="virtualPob">
            <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Virtual P.O Box</span>
        </a>
        <div class="collapse menu-dropdown {{ in_array(Route::currentRouteName(),
        ['virtualPob.index', 'virtualPob.waitingList', 'virtualPob.approved','virtualPob.details','virtualPob.dailyIncome','virtualPob.monthlyIncome']) ? 'show' : '' }}" id="virtualPob">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a href="{{ route('virtualPob.index') }}" class="nav-link {{ Request::routeIs('virtualPob.index') ? 'active' : '' }}" data-key="t-virtual">P.O Box List</a>
                </li>

                <li class="nav-item">
                    <a href="#sidebarCandidatelists" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCandidatelists" data-key="t-candidate-lists">
                        P.O Box Application
                    </a>
                    <div class="collapse menu-dropdown {{ in_array(Route::currentRouteName(), ['virtualPob.waitingList', 'virtualPob.approved']) ? 'show' : '' }}" id="sidebarCandidatelists">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('virtualPob.approved') }}" class="nav-link {{ Request::routeIs('virtualPob.approved') ? 'active' : '' }}" data-key="t-Approved"> Approved
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('virtualPob.waitingList') }}" class="nav-link {{ Request::routeIs('virtualPob.waitingList') ? 'active' : '' }}" data-key="t-Waiting-list"> Waiting list</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </li>
    @endcan
    @can('read mails', 'read ems')
    <li class="nav-item">
        <a class="nav-link menu-link " href="#nationalMail" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="nationalMail">
            <i class="bx bx-cart fs-22"></i> <span
                data-key="t-nationalMail">EMS National</span>
        </a>
        <div class="collapse menu-dropdown {{ in_array(Route::currentRouteName(), ['receiveDispatch.index', 'receiveDispatch.confirmed','receiveDispatch.show']) ? 'show' : '' }}" id="nationalMail">
            <ul class="nav nav-sm flex-column">
                {{-- view dispatch --}}
                <li class="nav-item">
                    <a href="{{ route('receiveDispatch.index') }}" class="nav-link {{ Request::routeIs('receiveDispatch.index') ? 'active' : '' }}" data-key="t-timeline"> View Dispatch </a>
                </li>
                {{-- Sent dispatch --}}
                <li class="nav-item">
                    <a href="{{ route('receiveDispatch.confirmed') }}" class="nav-link {{ Request::routeIs('receiveDispatch.confirmed') ? 'active' : '' }}" data-key="t-timeline"> Dispatch Confirmed </a>
                </li>


            </ul>
        </div>
    </li>
    @endcan

          @can('Manage Tarif')
          <li class="nav-item">
              <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
                  <i class="ri-pages-line"></i> <span data-key="t-pages">Service && Customer</span>
              </a>
              <div class="collapse menu-dropdown" id="sidebarPages">
                  <ul class="nav nav-sm flex-column">
                      <li class="nav-item">
                          <a href="{{ route('admin.serv.Service') }}" class="nav-link" data-key="t-starter">Service Type Registration</a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('admin.cust.Customers') }}" class="nav-link" data-key="t-starter">Customer Registration</a>
                      </li>

                  </ul>
              </div>
          </li>
      @endcan
      @can('Manage Tarif')
      <li class="nav-item">
          <a class="nav-link menu-link" href="#sidebarPagess" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
              <i class="ri-pages-line"></i> <span data-key="t-pages">EMS Tarif Registration</span>
          </a>
          <div class="collapse menu-dropdown" id="sidebarPagess">
              <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                      <a href="{{ route('admin.countri.Countries') }}" class="nav-link" data-key="t-starter">Country Registration</a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.zone.Zones') }}" class="nav-link" data-key="t-starter">Zone Registration</a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.range.ranges') }}" class="nav-link" data-key="t-starter">Weight Range Registration</a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.czone.czoness') }}" class="nav-link" data-key="t-starter">Tarif Registration</a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.tarif.zone') }}" class="nav-link" data-key="t-starter">Tarif View All Zone</a>
                  </li>

              </ul>
          </div>
      </li>
  @endcan
  @can ('read income')
  <li class="nav-item">
      <a class="nav-link menu-link" href="#seling_carte_postel" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="seling_carte_postel">
          <i class="ri-pages-line"></i> <span data-key="t-pages">Revenue Registration</span>
      </a>
      <div class="collapse menu-dropdown" id="seling_carte_postel">
          <ul class="nav nav-sm flex-column">
              @can ('make outboxing')
              <li class="nav-item">
                  <a href="{{ route('branch.sellingpostel.index') }}" class="nav-link" data-key="t-starter">Carte Postel</a>
              </li>
              @endcan
              @can ('read income')
              <li class="nav-item">
                <a href="{{ route('admin.income.index') }}" class="nav-link" data-key="t-starter">Other Revenue</a>
            </li>
            @endcan
            @can ('create income types')
            <li class="nav-item">
                <a href="{{ route('admin.income_types.index') }}" class="nav-link" data-key="t-starter">New Revenue Type</a>
            </li>
            @endcan
            @can ('create income')
            <li class="nav-item">
                <a href="{{ route('admin.income.history') }}" class="nav-link" data-key="t-starter">Income History</a>
            </li>
            @endcan
              {{--  @can ('make outboxing')
              <li class="nav-item">
                  <a href="{{ route('branch.sellingpostel.history') }}" class="nav-link" data-key="t-starter">Sales History</a>
              </li>
              @endcan
              @can ('make outboxing')
              <li class="nav-item">
                  <a href="{{ route('branch.sellingpostel.report') }}" class="nav-link" data-key="t-starter">Sales Report</a>
              </li>
              @endcan
            --}}
          </ul>
      </div>
  </li>
  @endcan
  @can ('read expense')
  <li class="nav-item">
      <a class="nav-link menu-link" href="#expense_types_management" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="expense_types_management">
          <i class="ri-pages-line"></i> <span data-key="t-pages">Expense Registration</span>
      </a>
      <div class="collapse menu-dropdown" id="expense_types_management">
          <ul class="nav nav-sm flex-column">
              @can ('create expense types')
              <li class="nav-item">
                  <a href="{{ route('admin.expense_types.index') }}" class="nav-link" data-key="t-starter">New Expense Type</a>
              </li>
              @endcan
              @can ('read expense')
              <li class="nav-item">
                  <a href="{{ route('admin.expenses.index') }}" class="nav-link" data-key="t-starter">New Expense</a>
              </li>
              @endcan
             {{-- @can ('create expense')
              <li class="nav-item">
                  <a href="{{ route('admin.expenses.history') }}" class="nav-link" data-key="t-starter">Expenses History</a>
              </li>
              @endcan
            --}}
              @can ('read expense')
              <li class="nav-item">
                  <a href="{{ route('admin.expenses.approved') }}" class="nav-link" data-key="t-starter">Expenses Approved </a>
              </li>
              @endcan
              @can ('read expense')
              <li class="nav-item">
                  <a href="{{ route('admin.expenses.rejected') }}" class="nav-link" data-key="t-starter">Expenses Rejected </a>
              </li>
              @endcan

          </ul>
      </div>
  </li>
  @endcan
  @can ('Manage orders')
  <li class="nav-item">
      <a class="nav-link menu-link" href="#ordermanagement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="ordermanagement">
          <i class="ri-pages-line"></i> <span data-key="t-pages">Philatery Request</span>
      </a>
      <div class="collapse menu-dropdown" id="ordermanagement">
          <ul class="nav nav-sm flex-column">
              @can ('make branchorder')
              <li class="nav-item">
                  <a href="{{ route('branch.order.index') }}" class="nav-link" data-key="t-starter">Request Registraion</a>
              </li>
              @endcan
              @can ('make branchorder')
              <li class="nav-item">
                  <a href="{{ route('branch.order.status') }}" class="nav-link" data-key="t-starter">Store</a>
              </li>
              @endcan
              @can ('read branchorder')
              <li class="nav-item">
                  <a href="{{ route('branch.order.history') }}" class="nav-link" data-key="t-starter">Manage Request </a>
              </li>
              @endcan

              @can ('Approved History')
              <li class="nav-item">
                  <a href="{{ route('branch.order.approved') }}" class="nav-link" data-key="t-starter">Order Approved</a>
              </li>
              @endcan
              @can ('Approved History')
              <li class="nav-item">
                  <a href="{{ route('branch.order.rejected') }}" class="nav-link" data-key="t-starter">Order Rejected</a>
              </li>
              @endcan

          </ul>
      </div>
  </li>
  @endcan
  @can ('make outboxing')
  <li class="nav-item">
      <a class="nav-link menu-link" href="#mailincomereport" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="mailincomereport">
          <i class="ri-pages-line"></i> <span data-key="t-pages">Revenue Daily Reporting</span>
      </a>
      <div class="collapse menu-dropdown" id="mailincomereport">
          <ul class="nav nav-sm flex-column">

            <li class="nav-item">
                <a href="{{ route('admin.income.Oincames') }}" class="nav-link" data-key="t-one-page">Ordinary Inbox</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.incomer.Rincames') }}" class="nav-link" data-key="t-nft-landing">Registered Inbox</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.incomep.Pincames') }}" class="nav-link" data-key="t-nft-landing">Percel Inbox</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.incomeems.incomeemss') }}" class="nav-link" data-key="t-nft-landing">EMS Inbox</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.incomegoogle.Gincames') }}" class="nav-link" data-key="t-nft-landing">Google Ad Inbox</a>
            </li>
              @can ('make outboxing')
              <li class="nav-item">
                  <a href="{{ route('branch.outboxing.report') }}" class="nav-link" data-key="t-starter">EMS Outbox</a>
              </li>
              @endcan
              @can ('make outboxing')
              <li class="nav-item">
                  <a href="{{ route('branch.registeredoutboxing.report') }}" class="nav-link" data-key="t-starter">Registered Small Packet Outbox</a>
              </li>
              @endcan
              @can ('make outboxing')
              <li class="nav-item">
                  <a href="{{ route('branch.perceloutboxing.report') }}" class="nav-link" data-key="t-starter">Percel Outbox</a>
              </li>
              @endcan
              @can ('make outboxing')
              <li class="nav-item">
                  <a href="{{ route('branch.tembleoutboxing.report') }}" class="nav-link" data-key="t-starter">Posting With Temble Outbox</a>
              </li>
              @endcan
              @can ('make outboxing')
              <li class="nav-item">
                  <a href="{{ route('physicalPob.dailyIncome') }}" class="nav-link" data-key="t-starter">Physical P.O Box</a>
              </li>
              @endcan
              @can ('make outboxing')
              <li class="nav-item">
                  <a href="{{ route('virtualPob.dailyIncome') }}" class="nav-link" data-key="t-starter">Virtual P.O Box</a>
              </li>
              @endcan
              @can ('make outboxing')
              <li class="nav-item">
                  <a href="{{ route('admin.income.incomesreportbranch') }}" class="nav-link" data-key="t-starter">Other Revenue</a>
              </li>
              @endcan
              @can ('make outboxing')
              <li class="nav-item">
                  <a href="{{ route('admin.income.Homedelireportbranch') }}" class="nav-link" data-key="t-starter">Home Delivery</a>
              </li>
              @endcan

          </ul>
      </div>
  </li>
  @endcan

  @can ('read outboxing')
              <li class="nav-item">
                  <a class="nav-link menu-link" href="#agenciesreport" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="agenciesreport">
                      <i class="ri-pages-line"></i> <span data-key="t-pages">Report</span>
                  </a>
                  <div class="collapse menu-dropdown" id="agenciesreport">
                      <ul class="nav nav-sm flex-column">
                          @can ('make outboxing')
                          <li class="nav-item">
                              <a href="{{ route('branch.breporting.daily') }}" class="nav-link " data-key="t-starter">Daily Income Agencies </a>
                          </li>
                          @endcan
                          @can ('make outboxing')
                          <li class="nav-item">
                              <a href="{{ route('branch.breporting.monthly') }}" class="nav-link " data-key="t-starter">Monthly Income  Agencies</a>
                          </li>
                          @endcan
                          @can ('make outboxing')
                          <li class="nav-item">
                              <a href="{{ route('branch.breporting.expenses') }}" class="nav-link " data-key="t-starter">Daily Expenses Agencies</a>
                          </li>
                          @endcan
                          @can ('make outboxing')
                          <li class="nav-item">
                              <a href="{{ route('branch.breporting.profit') }}" class="nav-link" data-key="t-starter">Monthly (Income-Expense) Agencies</a>
                          </li>
                          @endcan

                      </ul>
                  </div>
              </li>
              @endcan

  @can('Manage Tarif')
  <li class="nav-item">
      <a class="nav-link menu-link" href="#sidebarPagesss" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
          <i class="ri-pages-line"></i> <span data-key="t-pages">Registered Small Packet</span>
      </a>
      <div class="collapse menu-dropdown" id="sidebarPagesss">
          <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                  <a href="{{ route('admin.regcountries.countriesview') }}" class="nav-link" data-key="t-starter">Country Registration</a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.prange.pranges') }}" class="nav-link" data-key="t-starter">Weight Range Registration</a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.rspatreg.rspatregs') }}" class="nav-link" data-key="t-starter">Tarif Registration</a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.tarif.continent') }}" class="nav-link" data-key="t-starter">Small Packet Tarif View</a>
              </li>

          </ul>
      </div>
  </li>
@endcan
@can('Manage Tarif')
      <li class="nav-item">
          <a class="nav-link menu-link" href="#sidebarPagessss" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
              <i class="ri-pages-line"></i> <span data-key="t-pages">Percel Tarif Registration</span>
          </a>
          <div class="collapse menu-dropdown" id="sidebarPagessss">
              <ul class="nav nav-sm flex-column">
                  <li class="nav-item">
                      <a href="{{ route('admin.percecountreg.percecountregs') }}" class="nav-link" data-key="t-starter">Country Registration</a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.pweight.pweights') }}" class="nav-link" data-key="t-starter">Weight Registration</a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.perceltreg.perceltregs') }}" class="nav-link" data-key="t-starter">Tarif Registration</a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('admin.tarif.country') }}" class="nav-link" data-key="t-starter">Percel Tarif View</a>
                  </li>

              </ul>
          </div>
      </li>
  @endcan
              {{-- can read Supplier --}}
              @can('read supplier')
              <li class="nav-item">
                  <a class="nav-link menu-link {{ Request::routeIs('admin.supplier.index') ? 'active' : '' }}" href="{{ route('admin.supplier.index') }}">
                      <i class="ri-user-star-line"></i> <span data-key="t-base-hu">Suppliers Management</span>
                  </a>

              </li>
              @endcan
              {{-- can read Category --}}
              @can('read category')
              <li class="nav-item">
                  <a class="nav-link menu-link {{ Request::routeIs('admin.category.index') ? 'active' : '' }}" href="{{ route('admin.category.index') }}">
                      <i class="ri-keyboard-box-line"></i> <span data-key="t-base-hu">Categories Management</span>
                  </a>

              </li>
              @endcan
              @can('read category')
              <li class="nav-item">
                  <a class="nav-link menu-link {{ Request::routeIs('admin.comments.comment') ? 'active' : '' }}" href="{{ route('admin.comments.Comment') }}">
                      <i class="ri-keyboard-box-line"></i> <span data-key="t-base-hu">Comment Registration</span>
                  </a>

              </li>
              @endcan
              {{-- can read Category --}}
              @can('read items')
              <li class="nav-item">
                  <a class="nav-link menu-link {{ Request::routeIs('admin.item.index') ? 'active' : '' }}" href="{{ route('admin.item.index') }}">
                      <i class="ri-keyboard-box-line"></i> <span data-key="t-base-hu">Items Management</span>
                  </a>

              </li>
              @endcan
              @can ('read purchase')
              <li class="nav-item">
                  <a class="nav-link menu-link" href="#purchase_management" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="purchase_management">
                      <i class="ri-pages-line"></i> <span data-key="t-pages">Purchase Management</span>
                  </a>
                  <div class="collapse menu-dropdown" id="purchase_management">
                      <ul class="nav nav-sm flex-column">
                          <li class="nav-item">
                              <a href="{{ route('admin.purchase.index') }}" class="nav-link" data-key="t-starter">New Purchase</a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('admin.purchase.list') }}" class="nav-link" data-key="t-starter">Purchase List</a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('admin.purchase.report') }}" class="nav-link" data-key="t-starter">Purchase Report</a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('admin.purchase.stock') }}" class="nav-link" data-key="t-starter">Stock Report</a>
                          </li>

                      </ul>
                  </div>
              </li>
              @endcan



              @can ('read summarized report')
              <li class="nav-item">
                  <a class="nav-link menu-link" href="#mailincomereport" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="mailincomereport">
                      <i class="ri-pages-line"></i> <span data-key="t-pages">Mail Income Report</span>
                  </a>
                  <div class="collapse menu-dropdown" id="mailincomereport">
                      <ul class="nav nav-sm flex-column">
                          @can ('read summarized report')
                          <li class="nav-item">
                              <a href="{{ route('admin.reporting.ems') }}" class="nav-link" data-key="t-starter">EMS Mail income Report</a>
                          </li>
                          @endcan
                          @can ('read summarized report')
                          <li class="nav-item">
                              <a href="{{ route('admin.reporting.registered') }}" class="nav-link" data-key="t-starter">Registered Small Packet Income Report</a>
                          </li>
                          @endcan
                          @can ('read summarized report')
                          <li class="nav-item">
                              <a href="{{ route('admin.reporting.percel') }}" class="nav-link" data-key="t-starter">Percel Outboxing Income Report</a>
                          </li>
                          @endcan
                          @can ('read summarized report')
                          <li class="nav-item">
                              <a href="{{ route('admin.reporting.temble') }}" class="nav-link" data-key="t-starter">Posting With Temble Income Report</a>
                          </li>
                          @endcan
                          @can ('read summarized report')
                          <li class="nav-item">
                              <a href="{{ route('admin.reporting.postel') }}" class="nav-link" data-key="t-starter">Carte Postel Selling Report</a>
                          </li>
                          @endcan

                      </ul>
                  </div>
              </li>
              @endcan


              @can ('read summarized report')
              <li class="nav-item">
                  <a class="nav-link menu-link" href="#Summarized_Reports" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="Summarized_Reports">
                      <i class="ri-equalizer-fill"></i> <span data-key="t-pages">Activity Agencies Report</span>
                  </a>
                  <div class="collapse menu-dropdown" id="Summarized_Reports">
                      <ul class="nav nav-sm flex-column">
                          @can ('read summarized report')
                          <li class="nav-item">
                              <a href="{{ route('admin.reporting.daily') }}" class="nav-link {{ Request::routeIs('admin.reporting.daily') ? 'active' : '' }}" data-key="t-starter">Daily Income Agencies Report</a>
                          </li>
                          @endcan
                          @can ('read summarized report')
                          <li class="nav-item">
                              <a href="{{ route('admin.reporting.monthly') }}" class="nav-link {{ Request::routeIs('admin.reporting.monthly') ? 'active' : '' }}" data-key="t-starter">Monthly Income Agencies Report</a>
                          </li>
                          @endcan
                          @can ('read summarized report')
                          <li class="nav-item">
                              <a href="{{ route('admin.reporting.profit') }}" class="nav-link {{ Request::routeIs('admin.reporting.profit') ? 'active' : '' }}" data-key="t-starter">Monthly General (Income-Expense) Agencies Report</a>
                          </li>
                          @endcan
                          @can ('read summarized report')
                          <li class="nav-item">
                              <a href="{{ route('admin.reporting.index') }}" class="nav-link {{ Request::routeIs('admin.reporting.index') ? 'active' : '' }}" data-key="t-starter">Activities Agencies Report</a>
                          </li>
                          @endcan
                          @can ('read summarized report')
                          <li class="nav-item">
                              <a href="{{ route('admin.reporting.expenses') }}" class="nav-link" data-key="t-starter">Expenses Agencies Report</a>
                          </li>
                          @endcan


                      </ul>
                  </div>
              </li>
              @endcan
