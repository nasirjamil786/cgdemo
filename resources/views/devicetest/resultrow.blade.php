                <tr>
                    <td>
                        <!-- Three COLUMNS -->
                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td valign="top" style="padding: 0;" class="mobile-wrapper">
                                    <!-- LEFT COLUMN -->
                                    <table cellpadding="0" cellspacing="0" border="0" width="25%" style="width: 30%;" align="left">
                                        <tr>
                                            <td style="padding: 0 0 0px 0;">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tr>
                                                        <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 14px;">
                                                            {{$test}}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- Middel Column -->
                                    <table cellpadding="0" cellspacing="0" border="0" width="10%" style="width: 10%;" align="left">
                                        <tr>
                                            <td style="padding: 0 0 0px 0;">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tr>

                                                        @if($result == 'Fail')
                                                            <td align="center" style="font-family: Arial, sans-serif; color: red; font-size: 14px;">{{$result}}
                                                            </td>
                                                        @else
                                                            <td align="center" style="font-family: Arial, sans-serif; color: #333333; font-size: 14px;"> @if($result == NULL ) NA @else {{$result}} @endif
                                                            </td>
                                                        @endif

                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- RIGHT COLUMN -->
                                    <table cellpadding="0" cellspacing="0" border="0" width="65%" style="width: 60%;" align="right">
                                        <tr>
                                            <td style="padding: 0px 0 0px 0;">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tr>
                                                        <td align="left" style="font-family: Arial, sans-serif; color: #333333; font-size: 12px;">{{$comments}}</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>